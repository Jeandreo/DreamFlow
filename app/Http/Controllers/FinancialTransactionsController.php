<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
use App\Models\FinancialCreditCard;
use App\Models\FinancialFature;
use App\Models\FinancialFaturesTransaction;
use App\Models\FinancialTransactions;
use App\Models\FinancialTransactionsRecurrent;
use App\Models\FinancialWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Collection;

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
    public function dashboard()
    {
        // Mapeamento de números de mês para meses em português
        $monthNames = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];

        // Inicializando os arrays de entrada e saída
        $entradas = array_fill(1, 12, 0);
        $saidas = array_fill(1, 12, 0);
        $aporte = array_fill(1, 12, 0);

        // Consultar o banco de dados para obter os totais mensais de entradas e saídas
        $transactions = FinancialTransactions::select(
            DB::raw('MONTH(date_purchase) as month'),
            DB::raw('SUM(value) as total')
        )
            ->whereYear('date_purchase', date('Y')) // Filtra o ano atual, pode ser modificado conforme necessário
            ->groupBy('month')
            ->get();

        foreach ($transactions as $transaction) {
            if ($transaction->total > 0) {
                $entradas[$transaction->month] += $transaction->total;
                $aporte[$transaction->month] += rand(20, 300);
            } elseif ($transaction->total < 0) {
                $saidas[$transaction->month] += abs($transaction->total);
            }
            $aporte[$transaction->month] += rand(20, 300);
        }

        // Organizando os dados para a variável $series
        $series = [
            [
                'name' => 'Entrada',
                'data' => array_values($entradas),
            ],
            [
                'name' => 'Saída',
                'data' => array_values($saidas),
            ],
            [
                'name' => 'Aporte',
                'data' => array_values($aporte),
            ],
        ];

        $currentMonth = Carbon::now()->format('Y-m');

        // Filtrar transações pelo mês atual e calcular as somas das entradas e saídas
        $entriesSum = FinancialTransactions::where('value', '>=', 0)
            ->where('date_payment', 'like', $currentMonth . '%')
            ->sum('value');

        $exitsSum = FinancialTransactions::where('value', '<', 0)
            ->where('date_payment', 'like', $currentMonth . '%')
            ->sum('value');

        // Calcula a diferença
        $difference = $entriesSum + $exitsSum;

        // Retorna os resultados em um array
        $values = [
            'revenues' => $entriesSum,
            'expenses' => $exitsSum,
            'difference' => $difference,
        ];

        // Obtém cartões de crédito
        $wallets = FinancialWallet::where('status', 1)->get();
        $credits = FinancialCreditCard::where('status', 1)->get();

        return view('pages.financial.index')->with([
            'values' => $values,
            'series' => $series,
            'balance' => $this->balance(),
            'monthNames' => array_values($monthNames),
            'wallets' => $wallets,
            'credits' => $credits,
            'pageClean' => true,
        ]);
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
            'pageClean' => true,
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

        // Obtém os dados do formulário
        $data = $request->all();

        // Salva as informações de quem criou
        $data['created_by'] = !isset($data['created_by']) ? Auth::id() : $data['created_by'];

        // Formata o valor monetário
        $data['value'] = toDecimal($data['value']);

        // Se for uma despesa registra como negativo
        if ($data['type'] == 'expense') {
            $data['value'] = -$data['value'];
        }

        // Se for crédito
        if ($data['method'] == 'credit') {
            $data['credit_card_id'] = $data['method_id'];
        }

        // Se for carteira
        if ($data['method'] == 'wallet') {
            $data['date_payment'] = $data['date_purchase'];
            $data['wallet_id'] = $data['method_id'];
        }

        // Se for parcelamento (em XX vezes)
        if ($data['installments'] ==  true) {

            // Atrelamento
            $data['hitching'] = $this->getHitching();

            // Informa que não será recorrente:
            $data['recurrent'] = false;

            // Obtém parcelas
            $installments = $data['installments_quantity'];

            // Salva nome
            $name = $data['name'];

            for ($i = 1; $i <= $installments; $i++) {

                // Pula o primeiro mês
                if ($i != 1) {
                    $data['date_payment'] = Carbon::parse($data['date_payment'])->addMonths(1)->format('Y-m-d');
                }

                // Ajusta nome
                $data['name'] = "$name - ($i/$installments)";

                // Registra cada parcela
                $insertTable = $this->repository->create($data);
            }

            // Redireciona
            return response()->json('Transaction created with success', 200);
        }

        // Registra transação
        $insertTable = $this->repository->create($data);

        // Se for no crédito, relaciona a fatura do mês.
        if ($data['method'] == 'credit') {

            // Obtém cartão de crédito
            $credit = FinancialCreditCard::find($data['method_id']);

            // Calcular o próximo mês e ano
            $nextMonth = Carbon::parse($data['date_purchase'])->addMonth()->month;
            $nextYear = Carbon::parse($data['date_purchase'])->addMonth()->year;

            // É uma fatura
            $data['fature'] = true;

            // Verificar ou criar a fatura
            $fature = FinancialFature::firstOrCreate(
                [
                    'credit_card_id' => $data['method_id'],
                    'month' => $nextMonth,
                    'year' => $nextYear,
                    'day' => $credit->due_day,
                ],
            );

            // Salva Fatura
            FinancialFaturesTransaction::create([
                'transaction_id' => $insertTable->id,
                'fature_id' => $fature->id,
            ]);
        }

        // Se for recorrente cria a recorrencia
        if ($data['recurrent'] == true) {

            // Gera recorrencia
            $recurrence = FinancialTransactionsRecurrent::create([
                'transaction_id' => $insertTable->id,
                'start' => $data['date_payment'],
            ]);

            // Salva atrelamento
            $insertTable->recurrent_id = $recurrence->id;
            $insertTable->save();
        }

        // REDIRECT AND MESSAGES
        return response()->json('Transaction created with success', 200);
    }

    public function getHitching()
    {

        // Get Last Hitching
        $last = FinancialTransactions::max('hitching');

        if (!$last) {
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
        if (!$content = $this->repository->find($id))
            return redirect()->back();

        // GET FORM DATA
        $data = $request->all();

        // FORMAT DATA
        $data['value'] = toDecimal($data['value']);

        // IF EXPENSE
        if ($data['type'] == 'expense') {
            $data['value'] = -$data['value'];
        }

        // IF CREDIT
        if ($data['method'] == 'credit') {
            $data['wallet_id']      = null;
            $data['credit_card_id'] = $data['method_id'];
        } else {
            $data['date_payment']   = $data['date_purchase'];
            $data['wallet_id']      = $data['method_id'];
            $data['credit_card_id'] = null;
        }

        // Se for recorrente cria a recorrencia
        if ($content->recurrent) {

            // Gera recorrencia
            $content->recurrent->start = $data['date_payment'];
            $content->recurrent->save();
        }

        // UPDATE OR MAKE NEW
        if ($request->preview == 'false') {
            $data['updated_by'] = Auth::id();
            $content->update($data);
        } else {
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
        if (!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.financial_transactions._form')->with([
            'content' => $content,
            'wallets' => $wallets,
            'credits' => $credits,
            'categories' => $categories,
            'type' => $content->value > 0 ? 'revenue' : 'expense',
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

        // Se não for uma fatura
        if ($request->type != 'Fature') {

            // Obtém transação
            $transaction = $this->repository->find($request->id);

            // Obtém dados da transação
            $data = $transaction->toArray();

            // FORMAT CHECKED
            $data['paid'] = $request->paid == 'true' ? true : false;

            // Se for uma pré-visualização de um lançamento recorrente
            if ($request->preview == 'true') {
                $data['date_purchase'] = $request->date;
                $data['date_payment'] = $request->date;
                $data['date_paid'] = now();
                $data['updated_by'] = null;
                $data['created_by'] = Auth::id();
                $transaction = $transaction->create($data);
            } else {
                // STORING NEW DATA
                $data['updated_by'] = Auth::id();
                $data['date_paid'] = now();
                $transaction->update($data);
            }

            // Se a transação for um recebimento, o valor recebido é o mesmo que o pago
            if ($transaction->value_paid == 0) {
                $transaction->value_paid = $transaction->value;
                $transaction->save();
            }
        } else {

            // Obtém dados da transação
            $data = $request->toArray();

            // Extrair os parâmetros fornecidos
            $creditCardId = $data['id'];
            $date = Carbon::parse($data['date']);

            // Obter o mês e o ano da fatura
            $month = $date->month;
            $year = $date->year;

            // Buscar a fatura para o cartão de crédito dentro do mês e ano fornecidos
            $fature = FinancialFature::where('credit_card_id', $creditCardId)
                ->where('month', $month)
                ->where('year', $year)
                ->first();

            $fature->paid = $fature->paid ? false : true;
            $fature->save();
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
    public function destroy(Request $request, $id)
    {

        // VERIFY IF EXISTS
        if (!$content = $this->repository->find($id))
            return redirect()->back();

        // VERIFY RECURRENCE
        if($recurrence = $content->recurrent){
            $recurrence->delete();
        }

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
        // Extrai dados
        $data = $request->all();
    
        // Inicia a consulta com junções e seleções
        $query = $this->transactions($data);
    
        // Realiza pesquisa pelo input
        $query = $this->search($query, $request);
    
        // Aplica a ordenação
        $query = $this->ordering($query, $request);
    
        // Itens por página e paginação
        $query->paginate($request->per_page);
    
        // Transações
        $transactions = $query->get()->toArray();
    
        // Obtém as transações recorrente
        $recurrents = $this->recurringTransactions($data, $transactions);
    
        // Mescla as duas coleções
        $transactions = collect($transactions)->merge($recurrents);
    
        // Obtém Faturas
        $fatures = $this->fatureTransactions($data);
    
        // Mescla as duas coleções
        $transactions = collect($transactions)->merge($fatures);
    
        // Ordena a coleção final
        $transactions = $transactions->sortBy([
            // 1. Entradas primeiro (valores positivos), depois saídas
            fn ($a, $b) => ($a->value >= 0 ? 0 : 1) <=> ($b->value >= 0 ? 0 : 1),
            // 2. Recorrência (recorrentes primeiro)
            fn ($a, $b) => (is_null($a->recurrent_id) ? 1 : 0) <=> (is_null($b->recurrent_id) ? 1 : 0),
            // 3. Data (mais antigas primeiro)
            fn ($a, $b) => strtotime($a->date_payment) <=> strtotime($b->date_payment),
            // 4. Nome (ordem alfabética)
            fn ($a, $b) => strcmp($a->name, $b->name),
        ])->values(); // values() para reindexar o array
    
        // Agrupamento dos resultados esperados e lançados
        $expected = $this->expected($request);
    
        // Obtém total pago
        $current = $this->current($request);
    
        // COUNT TOTAL RECORDS
        $totalRecords = count($transactions);
    
        // Remove os ajustes de carteira
        // $data = collect($data)->where('adjustment', false);
        // Configurar as colunas usando a função editColumn
        return FacadesDataTables::of($transactions)
            ->editColumn('checked', function ($row) {

                // Se for um ajuste ou uma transação ed fatura não permite "Pagar"
                if (isset($row->adjustment) && $row->adjustment == true || $row->type == 'Wallet' && $row->credit_card_id && $row->type == 'Wallet' && !$row->fature) {
                    return '-';
                } else {
                    return "<div class='form-check form-check-sm form-check-custom form-check-solid ps-3 cursor-pointer'>
                                <input class='form-check-input cursor-pointer transaction-paid' type='checkbox' value='$row->id' " . ($row->paid ? 'checked' : null) . ">
                            </div>";
                }
            })
            ->editColumn('name', function ($row) {

                $isPreview       = isset($row->preview) ? 'true' : 'false';
                $isFature        = isset($row->fature) && $row->fature == true ? 'true' : 'false';
                $isFaturePreview = isset($row->fature_preview) ? 'true' : 'false';
                $recurrent       = $row->recurrent_id ? '<i class="fa-solid fa-retweet ' . (isset($row->preview) ? 'text-danger' : 'text-primary') . '"></i>' : '<span></span>';
                $date            = date('Y-m-d', strtotime($row->date_purchase));

                return "<span data-search='$row->name' class='show' data-id='$row->id' data-preview='$isPreview' data-type='$row->type' data-date='$date' data-fature='$isFature' data-fature-preview='$isFaturePreview'>
                            " . (isset($row->adjustment) && $row->adjustment == 1 ? 'Ajuste de saldo ' : '') . Str::limit($row->name, 30) . " $recurrent
                        </span>";
            })
            ->editColumn('category_id', function ($row) {

                // Se não for fatura pega os ícones e cores personalizados, se tiver pai, pega os do pai.
                if (!isset($row->fature) || $row->fature == false) {
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
            ->editColumn('date', function ($row) {
                return date('d/m/Y', strtotime($row->date_payment));
            })
            ->editColumn('value', function ($row) {
                $class = $row->value < 0 ? 'text-danger' : 'text-success';
                return "<span class='$class'>R$ " . number_format($row->value, 2, ',', '.') . "</span>";
            })
            ->editColumn('wallet_credit', function ($row) {
                if ($row->id && $row->has_wallet) {
                    return "
                    <span class='badge py-2 fw-bold fs-8 px-3' style='background: " . hex2rgb($row->wallet_color, 7) . "; color: " . $row->wallet_color . "'>
                        <i class='fa-solid fa-wallet fs-9 me-1' style='color: " . hex2rgb($row->wallet_color, 70) . "'></i>
                        $row->wallet_name
                    </span>";
                } elseif ($row->id && $row->credit_card_id) {
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
            ->editColumn('actions', function ($row) {

                // Adiciona buscar transações
                if (isset($row->fature) && $row->fature) {
                    $showTransactios = "<button type='button' class='show-sub-transactions btn btn-sm btn-light btn-active-light-primary toggle h-35px me-3'
                                            <span data-credit-card='" . $row->credit_card_id . "'><i class='fa-solid fa-circle-plus'></i></span>
                                        </button>";
                    $btnDelete = '';
                } else {
                    $showTransactios = '';
                    $btnDelete = "<button class='btn btn-sm btn-icon btn-light-danger btn-active-light-primary text-hover-white h-35px w-35px me-3 remove-transaction' data-transaction='$row->id'>
                                    <i class='fa-solid fa-trash-can text-danger'></i>
                                </button>";
                }

                return $showTransactios . $btnDelete . "<button class='btn btn-light btn-active-light-primary btn-sm me-3 py-1 h-30px my-auto'>Ações</button>";
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

    /**
     * Inicializa a consulta com junções e seleção de colunas.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function current($request)
    {

        // Define a data de término
        $dateEnd = Carbon::parse($request->date_end);


        // Obtém todas as transações recorrentes
        $recurrences = $this->getActiveRecurrents($dateEnd);

        $currentMonthRevenues = 0;
        $currentMonthExpenses = 0;

        // Itera sobre as transações recorrentes
        foreach ($recurrences as $recurrentTransaction) {

            // Obtém o valor da transação e a data de início da recorrência
            $transactionValue = $recurrentTransaction->transaction->value;

            // Adiciona o valor ao mês em questão (só uma vez, não precisa de laço)
            if ($transactionValue > 0) {
                $currentMonthRevenues += $transactionValue;
            } else {
                $currentMonthExpenses += abs($transactionValue);
            }
        }

        $currentMonthNonRecurringRevenues = FinancialTransactions::whereNull('recurrent_id')
            ->whereMonth('date_payment', $dateEnd->month)
            ->whereYear('date_payment', $dateEnd->year)
            ->where('value', '>', 0)
            ->sum('value');

        $currentMonthNonRecurringExpenses = FinancialTransactions::whereNull('recurrent_id')
            ->whereMonth('date_payment', $dateEnd->month)
            ->whereYear('date_payment', $dateEnd->year)
            ->where('value', '<', 0)
            ->sum('value');

        $currentMonthFatureExpenses = 0;

        // Obter o mês e o ano da fatura
        $month = $dateEnd->month;
        $year = $dateEnd->year;
        $totalFatureExpenses = 0;

        // Buscar a fatura para o cartão de crédito dentro do mês e ano fornecidos
        $fatures = FinancialFature::where('month', $month)
            ->where('year', $year)
            ->get();

            
        foreach ($fatures as $fature) {
            $totalFatureExpenses += $fature->transactions()->sum('value');
            $currentMonthFatureExpenses += $fature->transactions()->sum('value');
        }

        $currentMonthRevenues += $currentMonthNonRecurringRevenues;
        $currentMonthExpenses += abs($currentMonthNonRecurringExpenses) + abs($currentMonthFatureExpenses);

        $currentMonthDifference = $currentMonthRevenues - $currentMonthExpenses;

        // Resultados
        $results = [
            'revenue' => $currentMonthRevenues,
            'expense' => $currentMonthExpenses,
            'total' => $currentMonthDifference,
        ];

        return $results;
    }


    public function getActiveRecurrents($dateEnd)
    {

        return FinancialTransactionsRecurrent::where('start', '<=', $dateEnd)
            ->where(function ($query) use ($dateEnd) {
                $query->where('end', '<=', $dateEnd)
                    ->orWhereNull('end');
            })
            ->where('status', true)
            ->get();
    }

    /**
     * Inicializa a consulta com junções e seleção de colunas.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function expected($request)
    {
        // Define a data de término
        $dateEnd = Carbon::parse($request->date_end);

        // Obtém todas as transações recorrentes
        $recurrences = $this->getActiveRecurrents($dateEnd);

        // Inicializa variáveis para armazenar os valores calculados
        $totalRevenues = 0;
        $totalExpenses = 0;

        // Itera sobre as transações recorrentes
        foreach ($recurrences as $recurrentTransaction) {

            // Obtém o valor da transação e a data de início da recorrência
            $transactionValue = $recurrentTransaction->transaction->value;
            $recurrentBegin = Carbon::parse($recurrentTransaction->start);

            // Calcula a diferença de meses entre a data de início e a data final simulada
            $monthsDifference = $recurrentBegin->diffInMonths($dateEnd);

            // Soma o valor para cada mês até o mês final (incluindo o mês inicial)
            for ($i = 0; $i <= $monthsDifference; $i++) {
                if ($transactionValue > 0) {
                    $totalRevenues += $transactionValue;
                } else {
                    $totalExpenses += abs($transactionValue);
                }
            }
        }

        // Soma as transações não recorrentes (total e do mês atual)
        $nonRecurringRevenues = FinancialTransactions::whereNull('recurrent_id')
            ->where('date_payment', '<=', $dateEnd)
            ->where('value', '>', 0)
            ->sum('value');

        $nonRecurringExpenses = FinancialTransactions::whereNull('recurrent_id')
            ->where('date_payment', '<=', $dateEnd)
            ->where('value', '<', 0)
            ->sum('value');

        // Obter o mês e o ano da fatura
        $month = $dateEnd->month;
        $year = $dateEnd->year;

        // Buscar a fatura para o cartão de crédito dentro do mês e ano fornecidos
        $fatures = FinancialFature::where('month', $month)
            ->where('year', $year)
            ->get();

        // Adiciona o valor das faturas do mês
        $totalFatureExpenses = 0;
        $currentMonthFatureExpenses = 0;
        foreach ($fatures as $fature) {
            $totalFatureExpenses += $fature->transactions()->sum('value');
            $currentMonthFatureExpenses += $fature->transactions()
                ->whereMonth('date_payment', $month)
                ->whereYear('date_payment', $year)
                ->sum('value');
        }

        // Calcula os totais (totais e mês atual)
        $totalRevenues += $nonRecurringRevenues;
        $totalExpenses += abs($nonRecurringExpenses) + abs($totalFatureExpenses);
        $difference = $totalRevenues - $totalExpenses;

        // Resultados
        $results = [
            'revenue'   => $totalRevenues,
            'expense'   => $totalExpenses,
            'total'     => $difference,
        ];

        return $results;
    }


    /**
     * Inicializa a consulta com junções e seleção de colunas.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function transactions($data)
    {

        // Inicia a consulta
        $query = DB::table('financial_transactions');

        // Junta com a tabela de categorias
        $query->leftJoin('financial_categories', function ($join) {
            $join->on('financial_transactions.category_id', '=', 'financial_categories.id');
        });

        // Verifica se a categoria possui uma categoria pai
        $query->leftJoin('financial_categories as category_father', function ($join) {
            $join->on('category_father.id', '=', 'financial_categories.father_id');
        });

        // Junta com a tabela de carteiras
        $query->leftJoin('financial_wallets', function ($join) {
            $join->on('financial_transactions.wallet_id', '=', 'financial_wallets.id');
        });

        // Junta aos cartões de crédito
        $query->leftJoin('financial_credit_cards', function ($join) {
            $join->on('financial_transactions.credit_card_id', '=', 'financial_credit_cards.id');
        });

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
            'financial_transactions.recurrent_id    as recurrent_id',
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

        // Se estiver filtrando por data
        if ($data['date_begin'] && $data['date_end']) {
            $query->whereBetween('financial_transactions.date_payment', [$data['date_begin'], $data['date_end']]);
        }

        // Executa consulta em trás array
        return $query;
    }

    /**
     * Agrupa as compras no cartão de crédito em uma fatura.
     *
     * @param \Illuminate\Support\Collection $data
     * @return \Illuminate\Support\Collection
     */
    public function fatureTransactions($data)
    {

        // Supondo que você tenha os valores de início e fim
        $start = Carbon::parse($data['date_begin']);

        // Obter todas as faturas do mês e ano especificados
        $fatures = FinancialFature::where('month', $start->month)
            ->where('year', $start->year)
            ->get();

        // Inicializa uma coleção vazia
        $fatureCollection = new Collection();

        foreach ($fatures as $fature) {

            // Obtém o cartão de crédito
            $credit = FinancialCreditCard::find($fature['credit_card_id']);

            // Obtém mês por escrito
            $monthName = ucfirst(Carbon::parse(date("$start->year-$start->month-01"))->locale('pt_BR')->isoFormat('MMMM'));

            // Gera data da fatura
            $dueDate = $start->year . '-' . $start->month . '-' . $credit->due_day;

            // Obtém total
            $totalSum = $fature->transactions()->sum('value');

            // Cria objeto
            $fatureObject = (object)[
                'type' => 'Fature',
                'id' => $credit->id,
                'name' => 'Fatura de ' . $monthName . ' - ' . $credit->name,
                'date_purchase' => $dueDate,
                'date_payment' => $dueDate,
                'value' => $totalSum,
                'paid' => $fature->paid,
                'has_wallet' => null,
                'recurrent_id' => null,
                'fature' => true,
                'fature_preview' => true,
                'category' => 'Fatura',
                'has_father' => false,
                'credit_card_id' => $credit->id,
                'card_name' => $credit->name,
            ];

            // Adiciona o objeto à coleção
            $fatureCollection->push($fatureObject);
        }

        // Obtém coleção
        return collect($fatureCollection);
    }

    /**
     * Simula as transações recorrentes do mes atual.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Query\Builder
     */
    public function recurringTransactions($data, $transactions)
    {

        // Define a data de início do mês anterior
        $dateStart = Carbon::parse($data['date_begin']);
        $dateEnd = Carbon::parse($data['date_end']);


        // Obtém todas as transações recorrentes
        $recurrentFilter = $this->getActiveRecurrents($dateEnd);

        // Obtém apenas as recorrentes
        $transactionsRecurrents = [];

        // Faz loop entre transações recorrentes
        foreach ($recurrentFilter as $recurrence) {

            // Obtém a transação modelo
            $transaction = $recurrence->transaction;
            
            // Formata data
            $newDate = $dateStart->format('Y-m-') . date('d', strtotime($transaction->date_payment));

            // Verifica se tem categorias
            $hasFather = $transaction->category->father_id ? true : false;

            // Verifica se já existe uma transação com o mesmo vínculo no mesmo mês
            $existingTransaction = collect($transactions)->first(function ($item) use ($recurrence, $newDate) {

                // Importante o vínculo (hitching) estar cadastrado
                return $item->recurrent_id == $recurrence->id && Carbon::parse($item->date_purchase)->isSameMonth($newDate);
            });

            // Se não houver transação criada, simula uma ficticia
            if (!$existingTransaction) {

                // Cria o objeto
                $trasactionSimulated = (object) [
                    'type'           => 'Recurrent',
                    'id'             => $transaction->id,
                    'name'           => $transaction->name,
                    'date'           => $newDate,
                    'date_payment'   => $newDate,
                    'date_purchase'  => $newDate,
                    'value'          => $transaction->value,
                    'paid'           => 0,
                    'has_wallet'     => false,
                    'hitching'       => $transaction->hitching,
                    'category'       => $transaction->category->name,
                    'recurrent_id'   => $recurrence->id,
                    'has_father'     => $hasFather,
                    'category_color' => $transaction->category->color,
                    'category_icon'  => $transaction->category->icon,
                    'father_color'   => $transaction->category->father->color ?? null,
                    'father_icon'    => $transaction->category->father->icon ?? null,
                    'wallet_name'    => $transaction->wallet_name,
                    'wallet_color'   => null,
                    'credit_card_id' => false,
                    'card_name'      => $transaction->card_name,
                    'preview'        => true,
                ];

                // Insere os dados
                $transactionsRecurrents[] = $trasactionSimulated;
            }
        }

        return $transactionsRecurrents;
    }

    /**
     * Aplica filtros de pesquisa à consulta.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Query\Builder
     */
    public function search($query, $request)
    {
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

        return $query;
    }

    /**
     * Aplica a ordenação à consulta.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Query\Builder
     */
    public function ordering($query, $request)
    {
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
        return $query;
    }

    /**
     * Aplica a ordenação à consulta.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Query\Builder
     */
    public function balance()
    {
        return $this->repository->where('paid', true)->sum('value_paid');
    }
}
