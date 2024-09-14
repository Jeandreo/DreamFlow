<?php

namespace App\Http\Controllers;

use App\Models\FinancialTransactions;
use Illuminate\Http\Request;

class TransactionsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function processing()
    {

        $transactionsController = new FinancialTransactionsController( );

        // Inicia a consulta com junções e seleções
        $query = $this->transactions($request);

        // Realiza pesquisa pelo input
        $query = $this->search($query, $request);

        // Aplica a ordenação
        $query = $this->ordering($query, $request);

        // Itens por página e paginação
        $query->paginate($request->per_page);

        // Transações
        $transactions = $query->get()->toArray();

        // Obtém as transações recorrente
        $recurrents = $this->recurringTransactions($request, $transactions);

        // Mescla as duas coleções
        $transactions = collect($transactions)->merge($recurrents);

        // Obtém Faturas
        $data = $this->fatureTransactions($transactions); 

        // Remove as transações de cartão
        $data = array_filter($data->toArray(), function($transaction) {
            return !($transaction->credit_card_id && $transaction->fature == 0);
        });

        // Organiza a coleção
        $collection = collect($data);

        // Agrupamento dos resultados esperados e lançados
        $expected = [
            'total' => $collection->sum('value'),
            'revenue' => $collection->where('value', '>', 0)->sum('value'),
            'expense' => $collection->where('value', '<', 0)->sum('value'),
        ];

        $current = [
            'total' => $collection->where('paid', true)->sum('value'),
            'revenue' => $collection->where('paid', true)->where('value', '>', 0)->sum('value'),
            'expense' => $collection->where('paid', true)->where('value', '<', 0)->sum('value'),
        ];
        
        // COUNT TOTAL RECORDS
        $totalRecords = count($data);

        // Remove os ajustes de carteira
        // $data = collect($data)->where('adjustment', false);
        
        // Configurar as colunas usando a função editColumn
        return FacadesDataTables::of($data)
            ->editColumn('checked', function($row) {

                // Se for um ajuste ou uma transação ed fatura não permite "Pagar"
                if(isset($row->adjustment) && $row->adjustment == true || $row->type == 'Wallet' && $row->credit_card_id && $row->type == 'Wallet' && !$row->fature){
                    return '-';
                } else {
                    return "<div class='form-check form-check-sm form-check-custom form-check-solid ps-3 cursor-pointer'>
                                <input class='form-check-input cursor-pointer transaction-paid' type='checkbox' value='$row->id' " . ($row->paid ? 'checked' : null) . ">
                            </div>";
                }

            })
            ->editColumn('name', function($row) {

                $isPreview       = isset($row->preview) ? 'true' : 'false';
                $isFature        = isset($row->fature) && $row->fature == true ? 'true' : 'false';
                $isFaturePreview = isset($row->fature_preview) ? 'true' : 'false';
                $recurrent       = $row->recurrent ? '<i class="fa-solid fa-retweet '. (isset($row->preview) ? 'text-danger' : 'text-primary') .'"></i>' : '<span></span>';
                $date            = date('Y-m-d', strtotime($row->date_purchase));

                return "<span data-search='$row->name' class='show' data-id='$row->id' data-preview='$isPreview' data-type='$row->type' data-date='$date' data-fature='$isFature' data-fature-preview='$isFaturePreview'>
                            " . (isset($row->adjustment) && $row->adjustment == 1 ? 'Ajuste de saldo ' : '') . Str::limit($row->name, 30) . " $recurrent
                        </span>";
            })
            ->editColumn('category_id', function($row) {

                // Se não for fatura pega os ícones personalizados
                if(!isset($row->fature) || $row->fature == false){
                    $color    = $row->has_father ? $row->father_color : $row->category_color;
                    $icon     = $row->has_father ? $row->father_icon  : $row->category_icon;
                    $category = $row->category;
                } else {
                    $color    = '#0076f5';
                    $icon     = 'fa-solid fa-receipt';
                    $category = 'Fatura';
                }

                // Gera HTML
                return "<span class='d-flex align-items-center fs-6 fw-normal'>
                            <div class='w-25px h-25px rounded-circle d-flex justify-content-center align-items-center me-2' style='background: $color;'>
                                <i class='$icon fs-7 text-white'></i>
                            </div>
                            <span class='text-gray-600'>$category</span>
                        </span>";

            })
            ->editColumn('date', function($row) {
                return date('d/m/Y', strtotime($row->date_payment));
            })
            ->editColumn('value', function($row) {
                $class = $row->value < 0 ? 'text-danger' : 'text-success';
                return "<span class='$class'>R$ " . number_format($row->value, 2, ',', '.') . "</span>";
            })
            ->editColumn('wallet_credit', function($row) {
                if ($row->id && $row->has_wallet) {
                    return "
                    <span class='badge py-2 fw-bold fs-8 px-3' style='background: " . hex2rgb($row->wallet_color, 7) . "; color: " . $row->wallet_color . "'>
                        <i class='fa-solid fa-wallet fs-9 me-1' style='color: " . hex2rgb($row->wallet_color, 70) . "'></i>
                        $row->wallet_name
                    </span>";
                } elseif($row->id && $row->credit_card_id) {
                    return "<span class='badge badge-light-danger py-2 fw-bold fs-8 px-3'>
                                <div class='d-flex align-items-center'>
                                    <i class='fa-solid fa-credit-card text-danger fs-9 me-1'></i>
                                    <span>$row->card_name</span>
                                </div>
                            </span>";
                } else {
                    return '<span class="badge badge-light">Não informado</span>';
                }
            })
            ->editColumn('actions', function($row) {

                // Adiciona buscar transações
                if(isset($row->fature) && $row->fature){
                    $showTransactios = "<button type='button' class='show-sub-transactions btn btn-sm btn-light btn-active-light-primary toggle h-35px me-3'
                                            <span data-credit-card='". $row->credit_card_id ."'><i class='fa-solid fa-circle-plus'></i></span>
                                        </button>";
                    $btnDelete = '';
                } else {
                    $showTransactios = '';
                    $btnDelete = "<button class='btn btn-sm btn-icon btn-light-danger btn-active-light-primary text-hover-white h-35px w-35px me-3 remove-transaction' data-transaction='$row->id'>
                                    <i class='fa-solid fa-trash-can text-danger'></i>
                                </button>";
                }

                return $showTransactios . $btnDelete . "<button class='btn btn-light btn-active-light-primary btn-sm me-3'>Ações</button>";

            })
            ->rawColumns(['checked', 'name', 'category_id', 'date', 'value', 'wallet_credit', 'actions'])
            ->setTotalRecords($totalRecords)
            ->setFilteredRecords($totalRecords)
            ->with([
                'expected' => $expected,
                'current'  => $current,
            ])
            ->toJson();
    }
}
