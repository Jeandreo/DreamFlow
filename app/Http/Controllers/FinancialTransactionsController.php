<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
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
        $categories = FinancialCategory::where('status', 1)->get();
        return view('pages.financial_transactions.index')->with([
            'wallets' => $wallets,
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

        // SEND DATA
        $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return response()->json('Sucess', 200);

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
        $categories = FinancialCategory::where('status', 1)->get();

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.financial_transactions._form')->with([
            'content' => $content,
            'wallets' => $wallets,
            'categories' => $categories,
        ]);
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
            $query->whereDate('financial_transactions.date_venciment', '>=', $request->date_begin);
        }

        // DATE END SELECTED
        if ($request->date_end) {
            $query->whereDate('financial_transactions.date_venciment', '<=', $request->date_end);
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
                    $column = 'financial_transactions.date_venciment';
                    break;
                case 'value':
                    $column = 'financial_transactions.value';
                    break;
                case 'category_id':
                    $column = 'financial_transactions.category_id';
                    break;
                case 'relationship':
                    $query->orderByRaw('CASE 
                        WHEN users.name IS NOT NULL THEN users.name
                        WHEN suppliers.name IS NOT NULL THEN suppliers.name
                        WHEN clients.name IS NOT NULL THEN clients.name
                        ELSE financial_transactions.relationship END ' . $direction);
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
            'financial_transactions.date_venciment  as date',
            'financial_transactions.value           as value',
            'financial_transactions.paid            as paid',
            'financial_transactions.wallet_id       as has_wallet',
            'financial_transactions.recurrent       as recurrent',
            'financial_transactions.hitching        as hitching',
            'financial_categories.name              as category',
            'financial_categories.father_id         as has_father',
            'financial_categories.color             as category_color',
            'category_father.name                   as father_name',
            'category_father.color                  as father_color',
            'financial_wallets.name                 as wallet_name',
            'financial_wallets.color                as wallet_color',
            'financial_transactions.credit_card_id  as has_credit',
            'financial_credit_cards.name            as card_name',
        );

        // EXECUTE THE QUERY TO GET THE RESULTS
        $data = $query->get()->toArray();

        // Obtém todas as transações recorrentes
        $recurringTransactions = FinancialTransactions::where('recurrent', true)->get()->values();

        // Adicione os dados de $additionalData diretamente ao array $data
        foreach ($recurringTransactions as $transaction) {

        // CONVERT TO CARBON
        $dateBegin = Carbon::parse($transaction->date_venciment);
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
                $newDate = Carbon::parse($transaction->date)->addMonths($i);

                // CONFIRM DATE BETWEEN DATE SELECTED
                if ($newDate->between($dateBegin, $dateEnd)) {

                    // CHECK IF THERE IS ALREADY A TRANSACTION WITH THE SAME HITCHING IN THE SAME MONTH
                    $existingTransaction = collect($data)->first(function ($item) use ($transaction, $newDate) {
                        return $item->hitching == $transaction->hitching && Carbon::parse($item->date)->isSameMonth($newDate);
                    });

                    // IF NO EXISTING TRANSACTION, ADD NEW ONE
                    if (!$existingTransaction) {
                        // MAKE OBJECT
                        $additionalData = (object) [
                            'id' => null,
                            'name' => $transaction->name,
                            'date' => $newDate->format('Y-m-d'),
                            'value' => $transaction->value,
                            'paid' => 0,
                            'has_wallet' => false,
                            'hitching' => $transaction->hitching,
                            'category' => $transaction->category->name,
                            'has_father' => $hasFather,
                            'category_color' => $transaction->category->color,
                            'father_color' => $transaction->category->father->color ?? null,
                            'wallet_name' => $transaction->wallet_name,
                            'wallet_color' => null,
                            'has_credit' => false,
                            'card_name' => $transaction->card_name,
                        ];

                        // INSERT IN DATA
                        $data[] = $additionalData;
                    }
                }
            }
        }

        // FILTER DATA BASED ON DATE AGAIN
        if ($request->date_begin) {
            $data = array_filter($data, function ($item) use ($request) {
                return Carbon::parse($item->date)->gte($request->date_begin);
            });
        }

        if ($request->date_end) {
            $data = array_filter($data, function ($item) use ($request) {
                return Carbon::parse($item->date)->lte($request->date_end);
            });
        }

        // COUNT TOTAL RECORDS
        $totalRecords = count($data);

        // OBTEM TOTAL
        $totalValue = collect($data)->sum('value');

        // Configurar as colunas usando a função editColumn
        return FacadesDataTables::of($data)
            ->editColumn('checked', function($row) {
                return "<div class='form-check form-check-sm form-check-custom form-check-solid ps-3'>
                            <input class='form-check-input' type='checkbox' value='$row->id' " . ($row->paid ? 'checked' : null) . ">
                        </div>";
            })
            ->editColumn('name', function($row) {
                return "<span data-search='$row->name' class='show' data-id='$row->id'>$row->name</span>";
            })
            ->editColumn('category_id', function($row) {
                $color = $row->has_father ? $row->father_color : $row->category_color;
                return "<span class='d-flex align-items-center fs-6 fw-normal'>
                            <div class='w-25px h-25px rounded-circle d-flex justify-content-center align-items-center me-2' style='background: $color;'>
                                <i class='fa-solid fa-home fs-7 text-white'></i>
                            </div>
                            <span class='text-gray-600'>$row->category</span>
                        </span>";
            })
            ->editColumn('date', function($row) {
                return date('d/m/Y', strtotime($row->date));
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
                return "<a href='#' class='btn btn-light btn-active-light-primary btn-sm me-3'>Ações</a>";
            })
            ->rawColumns(['checked', 'name', 'category_id', 'date', 'value', 'wallet_credit', 'actions'])
            ->setTotalRecords($totalRecords)
            ->setFilteredRecords($totalRecords)
            ->with(['totalSum' => $totalValue])
            ->toJson();
    }
}

