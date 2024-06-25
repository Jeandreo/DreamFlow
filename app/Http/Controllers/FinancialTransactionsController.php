<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
use App\Models\FinancialCreditCard;
use App\Models\FinancialTransactions;
use App\Models\FinancialWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class FinancialTransactionsController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, FinancialTransactions $content)
    {
        
        $this->request = $request;
        $this->repository = $content;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // GET DATA
        $wallets = FinancialWallet::where('status', 1)->get();
        $credits = FinancialCreditCard::where('status', 1)->get();
        $categories = FinancialCategory::where('status', 1)->get();
        return view('pages.financial_transactions.index')->with([
            'wallets' => $wallets,
            'credits' => $credits,
            'categories' => $categories,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // GET FORM DATA
        $data = $request->all();

        // CREATED BY
        $data['created_by'] = Auth::id();

        // FORMAT DATA
        $data['value'] = toDecimal($data['value']);

        // IF EXPENSE
        if($data['type'] == 'expense'){
            $data['value'] = -$data['value'];
        }

        // GET METHOD
        $method = explode('_', $data['wallet_or_credit']);

        // IF CREDIT
        if($method[0] == 'credit'){

            // Get Card
            $card = FinancialCreditCard::find($method[1]);

            // Date to Payment
            $yearMonth = Carbon::parse($data['date_purchase'])->addMonths(1)->format('Y-m-');
            $dateFature = $yearMonth . $card->due_day;
            $data['date_payment'] = $dateFature;

            // CardId
            $data['credit_card_id'] = $method[1];

        } else {
            $data['date_payment'] = $data['date_purchase'];
            $data['wallet_id'] = $method[1];
        }

        // IF RECURRENT OR INSTALLMENTS
        if($data['recurrent'] == true || $data['installments'] ==  true){
            $data['hitching'] = $this->getHitching();
        }

        if($data['installments'] ==  true){

            // Informa que não será recorrente:
            $data['recurrent'] = false;

            // Obtém parcelas
            $installments = $data['installments_quantity'];

            // Salva nome
            $name = $data['name'];

            for ($i = 1; $i <= $installments; $i++) { 

                // Pula o primeiro mês
                if($i != 1){
                    $data['date_payment'] = Carbon::parse($data['date_payment'])->addMonths(1)->format('Y-m-d');
                }

                // Ajusta nome
                $data['name'] = "$name - ($i/$installments)";
                
                // SEND DATA
                $this->repository->create($data);
                
            }

            // REDIRECT AND MESSAGES
            return response()->json('Transaction created with success', 200);

        }

        // SEND DATA
        $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return response()->json('Transaction created with success', 200);

    }

    public function getHitching(){

        // Get Last Hitching
        $last = FinancialTransactions::max('hitching');

        if(!$last){
            $hitching = 1;
        } else {
            $hitching = ++$last;
        }

        return $hitching;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // VERIFY IF EXISTS
        if(!$content = $this->repository->find($id))
        return redirect()->back();

        // GET FORM DATA
        $data = $request->all();

        // FORMAT DATA
        $data['value'] = toDecimal($data['value']);

        // IF EXPENSE
        if($data['type'] == 'expense'){
            $data['value'] = -$data['value'];
        }

        // GET METHOD
        $method = explode('_', $data['wallet_or_credit']);

        // IF CREDIT
        if($method[0] == 'credit'){
            $data['wallet_id'] = null;
            $data['credit_card_id'] = $method[1];
        } else {
            $data['date_payment'] = $data['date_purchase'];
            $data['wallet_id'] = $method[1];
            $data['credit_card_id'] = null;
        }

        // UPDATE OR MAKE NEW
        if($request->preview == 'false'){
            // STORING NEW DATA
            $data['updated_by'] = Auth::id();
            $content->update($data);
        } else {
            // STORING NEW DATA
            $data['created_by'] = Auth::id();
            $content->create($data);
        }

        // REDIRECT AND MESSAGES
        return response()->json('Transaction updated with success', 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // GET ALL DATA
        $content = $this->repository->find($id);
        $wallets = FinancialWallet::where('status', 1)->get();
        $credits = FinancialCreditCard::where('status', 1)->get();
        $categories = FinancialCategory::where('status', 1)->get();

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.financial_transactions._form')->with([
            'content' => $content,
            'wallets' => $wallets,
            'credits' => $credits,
            'categories' => $categories,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checked(Request $request)
    {

        if($request->type != 'Fature'){

            // Obtém transação
            $transaction = $this->repository->find($request->id);

            // GET FORM DATA
            $data = $transaction->toArray();

            // FORMAT CHECKED
            $data['paid'] = $request->paid == 'true' ? true : false;
        
            if($request->preview == 'true') {
    
                // STORING NEW DATA
                $data['date_purchase'] = $request->date;
                $data['date_payment'] = $request->date;
                $data['date_paid'] = now();
                $data['updated_by'] = null;
                $data['created_by'] = Auth::id();
                $transaction->create($data);
    
            } else {
                // STORING NEW DATA
                $data['updated_by'] = Auth::id();
                $data['date_paid'] = now();
                $transaction->update($data);
            } 

        } else {
            // Obtém cartão
            $cardId = $request->id;

            // Cartão
            $card = FinancialCreditCard::find($cardId);

            // Separa ano e mes
            $arrayDate = explode('-', $request->date);
            $year = $arrayDate[0];
            $month = $arrayDate[1];

            // Obtém total dos valores do mês
            $totalValue = FinancialTransactions::where('credit_card_id', $cardId)
                ->whereYear('date_payment', $year)
                ->whereMonth('date_payment', $month)
                ->sum('value');

            // Data de pagamento
            $yearMonthName = ucfirst(Carbon::parse(date($request->date))->locale('pt_BR')->isoFormat('MMMM'));

            $createFature = $this->repository->create([
                'credit_card_id' => $cardId,
                'category_id' => 0,
                'name' => 'Fatura de ' . $yearMonthName . ' - ' . $card->name,
                'fature' => true,
                'value' => $totalValue,
                'date_purchase' => $request->date,
                'date_payment' => $request->date,
                'date_paid' => now(),
                'paid' => true,
                'created_by' => Auth::id(),
            ]);

            // Salva em qual fatura foi paga
            FinancialTransactions::where('credit_card_id', $cardId)
                ->whereYear('date_payment', $year)
                ->whereMonth('date_payment', $month)
                ->update(['fature_id' => $createFature->id]);

        }


        // REDIRECT AND MESSAGES
        return response()->json('Transaction updated with success', 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        // VERIFY IF EXISTS
        if(!$content = $this->repository->find($request->id))
        return redirect()->back();

        // GET FORM DATA
        $content->delete();

        // REDIRECT AND MESSAGES
        return response()->json('Transaction updated with success', 200);

    }
    
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function processing(Request $request)
    {
        // Inicia a consulta
        $query = DB::table('financial_transactions');

        // Junta com a tabela de categorias
        $query->leftJoin('financial_categories', function($join) {
            $join->on('financial_transactions.category_id', '=', 'financial_categories.id');
        });

        // Verifica se a categoria possui uma categoria pai
        $query->leftJoin('financial_categories as category_father', function($join) {
            $join->on('category_father.id', '=', 'financial_categories.father_id');
        });

        // Junta com a tabela de carteiras
        $query->leftJoin('financial_wallets', function($join) {
            $join->on('financial_transactions.wallet_id', '=', 'financial_wallets.id');
        });

        // Junta aos cartões de crédito
        $query->leftJoin('financial_credit_cards', function($join) {
            $join->on('financial_transactions.credit_card_id', '=', 'financial_credit_cards.id');
        });
        
        // Pesquisa por termos
        if ($request->searchBy != '') {
            
            // Separa os termos
            $searchTerms = explode(' ', $request->searchBy);
            
            // Pesquisa por nome
            $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->whereRaw("LOWER(financial_transactions.name) LIKE ?", ['%' . strtolower($term) . '%']);
                }
            });

            // Ou pesquisa pelo nome da categoria
            $query->orWhere(function ($query) use ($request) {
                $query->where('financial_categories.name', 'like', "%$request->searchBy%");
            });
        }

        // Ordenação
        if ($request->order_by) {

            // Ordem e coluna
            $direction = $request->order[0]['dir'];
            $orderThis = $request->order_by;
            $column = $orderThis;

            // Formata as colunas
            switch ($column) {
                case 'name':
                    $column = 'financial_transactions.name';
                    break;
                case 'date':
                    $column = 'financial_transactions.date_purchase';
                    break;
                case 'value':
                    $column = 'financial_transactions.value';
                    break;
                case 'category_id':
                    $column = 'financial_transactions.category_id';
                    break;
                default:
                    $column = 'financial_transactions.id';
                    break;
            }

            // Executa
            $query->orderBy($column, $direction);

        }

        // Itens por página e paginação
        $query->paginate($request->per_page);

        // Seleciona colunas 
        $query->select(
            DB::raw('"Wallet"                       as type'),
            'financial_transactions.id              as id',
            'financial_transactions.name            as name',
            'financial_transactions.date_purchase   as date_purchase',
            'financial_transactions.date_payment    as date_payment',
            'financial_transactions.value           as value',
            'financial_transactions.paid            as paid',
            'financial_transactions.wallet_id       as has_wallet',
            'financial_transactions.recurrent       as recurrent',
            'financial_transactions.hitching        as hitching',
            'financial_transactions.fature          as fature',
            'financial_transactions.adjustment      as adjustment',
            'financial_categories.name              as category',
            'financial_categories.father_id         as has_father',
            'financial_categories.color             as category_color',
            'financial_categories.icon              as category_icon',
            'category_father.name                   as father_name',
            'category_father.color                  as father_color',
            'category_father.icon                   as father_icon',
            'financial_wallets.name                 as wallet_name',
            'financial_wallets.color                as wallet_color',
            'financial_transactions.credit_card_id  as credit_card_id',
            'financial_credit_cards.name            as card_name',
            'financial_credit_cards.due_day         as due_date',
        );

        // Executa consulta em trás array
        $data = $query->get()->toArray();

        // Obtém todas as transações recorrentes
        $recurringTransactions = FinancialTransactions::where('recurrent', true)->where('status', 1)->get()->values();

        // Faz loop entre transações recorrentes
        foreach ($recurringTransactions as $transaction) {

            // Formata data
            $dateBegin = Carbon::parse($transaction->date_payment);
            $dateEnd = Carbon::parse($request->date_end);

            // Obtém a diferença dos meses
            $yearMonthsDifference = $dateBegin->diffInMonths($dateEnd);

            // Verifica se tem categorias
            $hasFather = $transaction->category->father_id ? true : false;

            // Realiza loop entre a diferença dos meses
            for ($i = 0; $i <= $yearMonthsDifference; $i++) {

                // Obtém a data e adiciona meses com base na iteração do loop
                $newDate = Carbon::parse($transaction->date_purchase)->addMonths($i);

                // Confirma se a data está entre a data inicial e final selecionada
                if ($newDate->between($dateBegin, $dateEnd)) {

                    // Verifica se já existe uma transação com o mesmo vínculo no mesmo mês
                    $existingTransaction = collect($data)->first(function ($item) use ($transaction, $newDate) {

                        // Importante o vínculo (hitching) estar cadastrado
                        return $item->hitching == $transaction->hitching && Carbon::parse($item->date_purchase)->isSameMonth($newDate);

                    });

                    // Se não houver transação criada, simula uma ficticia
                    if (!$existingTransaction) {
                        
                        // Cria o objeto
                        $trasactionSimulated = (object) [
                            'type'           => 'Recurrent',
                            'id'             => $transaction->id,
                            'name'           => $transaction->name,
                            'date'           => $newDate->format('Y-m-d'),
                            'date_payment'   => $newDate->format('Y-m-d'),
                            'date_purchase'  => $newDate->format('Y-m-d'),
                            'value'          => $transaction->value,
                            'paid'           => 0,
                            'has_wallet'     => false,
                            'hitching'       => $transaction->hitching,
                            'category'       => $transaction->category->name,
                            'recurrent'      => true,
                            'has_father'     => $hasFather,
                            'category_color' => $transaction->category->color,
                            'category_icon'  => $transaction->category->icon,
                            'father_color'   => $transaction->father->color ?? null,
                            'father_icon'    => $transaction->father->icon ?? null,
                            'wallet_name'    => $transaction->wallet_name,
                            'wallet_color'   => null,
                            'credit_card_id' => false,
                            'card_name'      => $transaction->card_name,
                            'preview'        => true,
                        ];

                        // Insere os dados
                        $data[] = $trasactionSimulated;
                    }
                }
            }
        }

        // Obtém as transações de carteira e Crédito
        $data = collect($data);

        // Agrupa as compras no cartão de crédito em uma fatura
        $faturesCredit = collect($data)->where('credit_card_id', true);

        // Agrupar por mês e por cartão de crédito
        $faturesByMonth = $faturesCredit->groupBy(function ($item) {
            return Carbon::parse($item->date_payment)->format('Y-m-');
        })->map(function ($items) {
            return $items->groupBy('card_name');
        });

        // Faz looping entre faturas 
        foreach ($faturesByMonth as $yearMonth => $cards) {

            // Faz looping entre as cartões
            foreach($cards as $card => $transactions){

                // Verifica se já existe uma fatura criada
                $existFature = collect($transactions)->where('fature', true)->isNotEmpty();

                // Se não existir
                if(!$existFature){

                    // Formaata nome do mês
                    $monthName = ucfirst(Carbon::parse(date($yearMonth . $transactions[0]->due_date))->locale('pt_BR')->isoFormat('MMMM'));

                    // Cria objeto
                    $fature = (object) [
                        'type' => 'Fature',
                        'id' => $transactions[0]->credit_card_id,
                        'name' => 'Fatura de ' . $monthName . ' - ' . $card,
                        'date_purchase' => date($yearMonth . $transactions[0]->due_date),
                        'date_payment' => date($yearMonth . $transactions[0]->due_date),
                        'value' => $transactions->sum('value'),
                        'paid' => false,
                        'has_wallet' => null,
                        'recurrent' => null,
                        'fature' => true,
                        'category' => 'Fatura',
                        'has_father' => false,
                        'credit_card_id' => $transactions[0]->credit_card_id,
                        'card_name' => $card,
                        'year_month' => $yearMonth,
                    ];

                    // Insere fatura
                    $data->push($fature);
                }

            }

        }

        $previewTotalValue = collect($data)->sum('value');
        $previewTotalRevenue = collect($data)->where('value', '>', 0)->sum('value');
        $previewTotalExpense = collect($data)->where('value', '<', 0)->sum('value');
        $previewTotalPaidValue = collect($data)->where('paid', 1)->sum('value');

        // Obtém valores
        $totalValue = collect($data)->where('paid', true)->sum('value');
        $totalRevenue = collect($data)->where('paid', true)->where('value', '>', 0)->sum('value');
        $totalExpense = collect($data)->where('paid', true)->where('value', '<', 0)->sum('value');
        $totalPaidValue = collect($data)->where('paid', true)->where('paid', 1)->sum('value');

        // Filtra para que as faturas a serem exibidas estejam dentro do filtro
        $data = array_filter($data->toArray(), function ($item) use ($request) {
            $date = Carbon::parse($item->date_payment);
            return $date->gte($request->date_begin) && $date->lte($request->date_end);
        });

        // COUNT TOTAL RECORDS
        $totalRecords = count($data);

        // Remove as transações de cartão
        $data = array_filter($data, function($transaction) {
            return !($transaction->credit_card_id && $transaction->fature == 0);
        });


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
                $isPreview = isset($row->preview) ? 'true' : 'false';
                $recurrent = $row->recurrent ? '<i class="fa-solid fa-retweet '. (isset($row->preview) ? 'text-danger' : 'text-primary') .'"></i>' : '<span></span>';
                $date = date('Y-m-d', strtotime($row->date_purchase));
                return "<span data-search='$row->name' class='show' data-id='$row->id' data-preview='$isPreview' data-type='$row->type' data-date='$date'>
                    $row->name $recurrent
                </span>";
            })
            ->editColumn('category_id', function($row) {

                // Se não for fatura pega os ícones personalizados
                if(!isset($row->fature) || $row->fature == false){
                    $color    = $row->has_father ? $row->father_color : $row->category_color;
                    $icon     = $row->has_father ? $row->father_icon  : $row->category_icon;
                    $category = $row->category;
                } else {
                    $color    = '#007bff';
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
                } else {
                    $showTransactios = '';
                }

                return $showTransactios . "
                        <button class='btn btn-sm btn-icon btn-light-danger btn-active-light-primary text-hover-white h-35px w-35px me-3 remove-transaction' data-transaction='$row->id'>
                            <i class='fa-solid fa-trash-can text-danger'></i>
                        </button>
                        <button class='btn btn-light btn-active-light-primary btn-sm me-3'>Ações</button>";
            })
            ->rawColumns(['checked', 'name', 'category_id', 'date', 'value', 'wallet_credit', 'actions'])
            ->setTotalRecords($totalRecords)
            ->setFilteredRecords($totalRecords)
            ->with([
                'totalSum' => $totalValue,
                'totalRevenue' => $totalRevenue,
                'totalExpense' => $totalExpense,
                'totalPaidValue' => $totalPaidValue,
                
                'previewTotalSum' => $previewTotalValue,
                'previewTotalRevenue' => $previewTotalRevenue,
                'previewTotalExpense' => $previewTotalExpense,
                'previewTotalPaidValue' => $previewTotalPaidValue,
            ])
            ->toJson();
    }
}

