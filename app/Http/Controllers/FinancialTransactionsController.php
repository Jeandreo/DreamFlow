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
            $data['credit_card_id'] = $method[1];
        } else {
            $data['wallet_id'] = $method[1];
        }

        // SEND DATA
        $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return response()->json('Transaction created with success', 200);

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

        // VERIFY IF EXISTS
        if(!$content = $this->repository->find($request->id))
        return redirect()->back();

        // GET FORM DATA
        $data = $content->toArray();

        // FORMAT CHECKED
        $data['paid'] = $request->paid == 'true' ? true : false;

        // UPDATE OR MAKE NEW
        if($request->preview == 'false'){
            // STORING NEW DATA
            $data['updated_by'] = Auth::id();
            $content->update($data);
        } else {
            // STORING NEW DATA
            $data['date_payment'] = $request->date;
            $data['updated_by'] = null;
            $data['created_by'] = Auth::id();
            $content->create($data);
        }

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
        // BEGIN QUERY
        $query = DB::table('financial_transactions');
        
        // JOIN IN CATEGORIES
        $query->leftJoin('financial_categories', function($join) {
            $join->on('financial_transactions.category_id', '=', 'financial_categories.id');
        });

        // JOIN FIND FATHER OF CATEGORY
        $query->leftJoin('financial_categories as category_father', function($join) {
            $join->on('category_father.id', '=', 'financial_categories.father_id');
        });

        // JOIN IN WALLETS
        $query->leftJoin('financial_wallets', function($join) {
            $join->on('financial_transactions.wallet_id', '=', 'financial_wallets.id');
        });

        // JOIN IN CREDIT
        $query->leftJoin('financial_credit_cards', function($join) {
            $join->on('financial_transactions.credit_card_id', '=', 'financial_credit_cards.id');
        });

        // DATE BEGIN SELECTED
        if ($request->date_begin) {
            $query->whereDate('financial_transactions.date_purchase', '>=', $request->date_begin)->orWhereDate('financial_transactions.date_payment', '>=', $request->date_begin);
        }

        // DATE END SELECTED
        if ($request->date_end) {
            $query->whereDate('financial_transactions.date_purchase', '<=', $request->date_end)->orWhereDate('financial_transactions.date_payment', '>=', $request->date_begin);
        }

        // SEARCH BY
        if ($request->searchBy != '') {
            
            // SEPARE TERMS
            $searchTerms = explode(' ', $request->searchBy);
            
            // SEARCH BY NAME 
            $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->whereRaw("LOWER(financial_transactions.name) LIKE ?", ['%' . strtolower($term) . '%']);
                }
            });

            $query->orWhere(function ($query) use ($request) {
                $query->where('financial_categories.name', 'like', "%$request->searchBy%");
            });
        }

        // ORDER BY
        if ($request->order_by) {
            // ORDER & COLUMN
            $direction = $request->order[0]['dir'];
            $orderThis = $request->order_by;
            $column = $orderThis;

            // FORMATA COLUNAS
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
            $query->orderBy($column, $direction);
        }

        // ITENS PER PAGE AND PAGINATE
        $query->paginate($request->per_page);

        // SELECT DATA 
        $query->select(
            'financial_transactions.id              as id',
            'financial_transactions.name            as name',
            'financial_transactions.date_purchase   as date_purchase',
            'financial_transactions.date_payment    as date_payment',
            'financial_transactions.date_purchase   as date_purchase',
            'financial_transactions.value           as value',
            'financial_transactions.paid            as paid',
            'financial_transactions.wallet_id       as has_wallet',
            'financial_transactions.recurrent       as recurrent',
            'financial_transactions.hitching        as hitching',
            'financial_categories.name              as category',
            'financial_categories.father_id         as has_father',
            'financial_categories.color             as category_color',
            'financial_categories.icon              as category_icon',
            'category_father.name                   as father_name',
            'category_father.color                  as father_color',
            'category_father.icon                   as father_icon',
            'financial_wallets.name                 as wallet_name',
            'financial_wallets.color                as wallet_color',
            'financial_transactions.credit_card_id  as has_credit',
            'financial_credit_cards.name            as card_name',
            'financial_credit_cards.due_day         as due_date',
        );

        // EXECUTE THE QUERY TO GET THE RESULTS
        $data = $query->get()->toArray();

        // Obtém todas as transações recorrentes
        $recurringTransactions = FinancialTransactions::where('recurrent', true)->get()->values();

        // Adicione os dados de $additionalData diretamente ao array $data
        foreach ($recurringTransactions as $transaction) {

            // CONVERT TO CARBON
            $dateBegin = Carbon::parse($transaction->date_payment);
            $dateEnd = Carbon::parse($request->date_end);

            // GET DIFERENCE
            $monthsDifference = $dateBegin->diffInMonths($dateEnd);

            // VERIFY CATEGORY
            $hasFather = false;
            if ($transaction->has_father) {
                $hasFather = true;
            }

            // LOOP IN DIFFERENCE
            for ($i = 0; $i <= $monthsDifference; $i++) {

                // GET DATE AND ADD MONTHS BASED ON LOOP ITERATION
                $newDate = Carbon::parse($transaction->date_purchase)->addMonths($i);

                // CONFIRM DATE BETWEEN DATE SELECTED
                if ($newDate->between($dateBegin, $dateEnd)) {

                    // CHECK IF THERE IS ALREADY A TRANSACTION WITH THE SAME HITCHING IN THE SAME MONTH
                    $existingTransaction = collect($data)->first(function ($item) use ($transaction, $newDate) {

                        // Importante Hitching estar cadastrado
                        return $item->hitching == $transaction->hitching && Carbon::parse($item->date_purchase)->isSameMonth($newDate);
                    });


                    // IF NO EXISTING TRANSACTION, ADD NEW ONE
                    if (!$existingTransaction) {
                        
                        // MAKE OBJECT
                        $additionalData = (object) [
                            'id' => $transaction->id,
                            'name' => $transaction->name,
                            'date' => $newDate->format('Y-m-d'),
                            'date_payment' => $newDate->format('Y-m-d'),
                            'date_purchase' => $newDate->format('Y-m-d'),
                            'value' => $transaction->value,
                            'paid' => 0,
                            'has_wallet' => false,
                            'hitching' => $transaction->hitching,
                            'category' => $transaction->category->name,
                            'recurrent' => true,
                            'has_father' => $hasFather,
                            'category_color' => $transaction->category->color,
                            'category_icon' => $transaction->category->icon,
                            'father_color' => $transaction->category->father->color ?? null,
                            'father_icon' => $transaction->category->father->icon ?? null,
                            'wallet_name' => $transaction->wallet_name,
                            'wallet_color' => null,
                            'has_credit' => false,
                            'card_name' => $transaction->card_name,
                            'preview' => true,
                        ];

                        // INSERT IN DATA
                        $data[] = $additionalData;
                    }
                }
            }
        }

        // // Obtém as transações de carteira e Crédito
        $data = collect($data);

        // Agrupa as compras no cartão de crédito em uma fatura
        $faturesCredit = collect($data)->where('has_credit', true);

        // Agrupar por mês e por cartão de crédito
        $faturesByMonth = $faturesCredit->groupBy(function ($item) {
            return Carbon::parse($item->date_payment)->format('Y-m-');
        })->map(function ($items) {
            return $items->groupBy('card_name');
        });


        // Gera as faturas dos cartões
        foreach ($faturesByMonth as $month => $cards) {

            // Faz looping entre as faturas
            foreach($cards as $card => $transactions){

                // Data de pagamento
                $date = ucfirst(Carbon::parse(date($month . $transactions[0]->due_date))->locale('pt_BR')->isoFormat('MMMM'));

                $fatura = (object) [
                    'id' => 1,
                    'name' => 'Fatura de ' . $date . ' - ' . $card,
                    'date_purchase' => date($month . $transactions[0]->due_date),
                    'date_payment' => date($month . $transactions[0]->due_date),
                    'value' => $transactions->sum('value'),
                    'paid' => false,
                    'has_wallet' => null,
                    'recurrent' => null,
                    'hitching' => null,
                    'category' => 'Fatura',
                    'has_father' => false,
                    'category_color' => '#007bff',
                    'category_icon' => 'fa-solid fa-receipt',
                    'father_name' => null,
                    'father_color' => null,
                    'wallet_name' => null,
                    'wallet_color' => null,
                    'has_credit' => $transactions[0]->has_credit,
                    'card_name' => $card,
                    'extra_transactions' => $transactions->toArray(),
                ];

                $data->push($fatura);

            }

        }

        $data = array_filter($data->toArray(), function ($item) use ($request) {
            return Carbon::parse($item->date_purchase)->gte($request->date_begin);
        });

        $data = array_filter($data, function ($item) use ($request) {
            return Carbon::parse($item->date_purchase)->lte($request->date_end);
        });


        // COUNT TOTAL RECORDS
        $totalRecords = count($data);

        // OBTEM TOTAL
        $totalValue = collect($data)->sum('value');
        $totalRevenue = collect($data)->where('value', '>', 0)->sum('value');
        $totalExpense= collect($data)->where('value', '<', 0)->sum('value');
        $totalPaidValue = collect($data)->where('paid', 1)->sum('value');


        // Configurar as colunas usando a função editColumn
        return FacadesDataTables::of($data)
            ->editColumn('checked', function($row) {
                return "<div class='form-check form-check-sm form-check-custom form-check-solid ps-3 cursor-pointer'>
                            <input class='form-check-input cursor-pointer transaction-paid' type='checkbox' value='$row->id' " . ($row->paid ? 'checked' : null) . ">
                        </div>";
            })
            ->editColumn('name', function($row) {
                $isPreview = isset($row->preview) ? 'true' : 'false';
                $recurrent = $row->recurrent ? '<i class="fa-solid fa-retweet '. (isset($row->preview) ? 'text-danger' : 'text-primary') .'"></i>' : '<span></span>';
                $date = date('Y-m-d', strtotime($row->date_purchase));
                return "<span data-search='$row->name' class='show' data-id='$row->id' data-preview='$isPreview' data-date='$date'>
                    $row->name $recurrent
                </span>";
            })
            ->editColumn('category_id', function($row) {
                $color = $row->has_father ? $row->father_color : $row->category_color;
                $icon = $row->has_father ? $row->father_icon : $row->category_icon;
                return "<span class='d-flex align-items-center fs-6 fw-normal'>
                            <div class='w-25px h-25px rounded-circle d-flex justify-content-center align-items-center me-2' style='background: $color;'>
                                <i class='$icon fs-7 text-white'></i>
                            </div>
                            <span class='text-gray-600'>$row->category</span>
                        </span>";
            })
            ->editColumn('date', function($row) {
                return date('d/m/Y', strtotime($row->date_purchase));
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
                } elseif($row->id && $row->has_credit) {
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
                if(isset($row->extra_transactions)){
                    $showTransactios = " <button type='button' class='show-sub-transactions btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px me-3' data-fature='$row->has_credit-$row->date_purchase'
                                            <span data-transactions='". json_encode($row->extra_transactions) ."'><i class='fa-solid fa-circle-plus'></i></span>
                                        </button>";
                } else {
                    $showTransactios = '';
                }

                return $showTransactios  . "<a href='#' class='btn btn-light btn-active-light-primary btn-sm me-3'>Ações</a>";
            })
            ->rawColumns(['checked', 'name', 'category_id', 'date', 'value', 'wallet_credit', 'actions'])
            ->setTotalRecords($totalRecords)
            ->setFilteredRecords($totalRecords)
            ->with([
                'totalSum' => $totalValue,
                'totalRevenue' => $totalRevenue,
                'totalExpense' => $totalExpense,
                'totalPaidValue' => $totalPaidValue,
            ])
            ->toJson();
    }
}

