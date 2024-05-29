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
        
        // SEND DATA
        $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return response()->json('Sucess', 200);

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
            $join->on('category_father.id', '=', 'financial_categories.category_id');
        });

        // JOIN IN WALLETS
        $query->leftJoin('financial_wallets', function($join) {
            $join->on('financial_transactions.wallet_id', '=', 'financial_wallets.id');
        });

        // JOIN IN CREDIT
        $query->leftJoin('financial_credit_cards', function($join) {
            $join->on('financial_transactions.credit_card_id', '=', 'financial_credit_cards.id');
        });

        // DATE SELECTED
        if ($request->date_begin) {
            $query->whereDate('financial_transactions.date_venciment', '>=', $request->date_begin);
        }

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
        
        // COUNT TOTAL RECORDS
        $totalRecords = $query->select('financial_transactions.id')->count();




        // DATE SELECTED
        if ($request->date_begin) {
            $query->whereDate('financial_transactions.date_venciment', '>=', $request->date_begin);
        }

        if ($request->date_end) {
            $query->whereDate('financial_transactions.date_venciment', '<=', $request->date_end);
        }

        // Filtrar transações recorrentes
        $recurringTransactions = DB::table('financial_transactions')
            ->where('recurrent', 1)
            ->get();


        // Converta as datas para objetos Carbon
        $dateBegin = Carbon::parse($request->date_begin);
        $dateEnd = Carbon::parse($request->date_end);

        // Calcule a diferença de meses
        $monthsDifference = $dateBegin->diffInMonths($dateEnd);

        dd($recurringTransactions, $monthsDifference);

        // ITENS PER PAGE AND PAGINATE
        $pages = $query->paginate($request->per_page);

        $query->select(
            'financial_transactions.id              as id',
            'financial_transactions.name            as name',
            'financial_transactions.date_venciment  as date',
            'financial_transactions.value           as value',
            'financial_transactions.paid            as paid',
            'financial_transactions.wallet_id       as has_wallet',
            'financial_categories.name              as category',
            'financial_categories.category_id       as has_father',
            'financial_categories.color             as category_color',
            'category_father.name                   as father_name',
            'category_father.color                  as father_color',
            'financial_wallets.name                 as wallet_name',
            'financial_wallets.color                as wallet_color',
            'financial_credit_cards.name            as card_name',
        );

        // MAKE COLUMNS
        return FacadesDataTables::of($query)
        ->addColumn('checked', function($row){
            $html = "<div class='form-check form-check-sm form-check-custom form-check-solid ps-3'>
                        <input class='form-check-input' type='checkbox' value='$row->id' " . ($row->paid ? 'checked' : null) .">
                    </div>";
            return $html;
        })
        ->addColumn('name', function($row){
            $html = "<span class='show'data-id='$row->id'>$row->name</span>";
            return $html;
        })
        ->addColumn('category_id', function($row){

            // VERIFY IF HAS FATHER
            $color = $row->has_father ? $row->father_color : $row->category_color;

            $html = "<span class='d-flex align-items-center fs-6 fw-normal'>
                        <div class='w-25px h-25px rounded-circle d-flex justify-content-center align-items-center me-2' style='background: $color;'>
                            <i class='fa-solid fa-home fs-7 text-white'></i>
                        </div>
                        <span class='text-gray-600'>
                        $row->category
                        </span>
                    </span>";
            return $html;
        })
        ->addColumn('date', function($row){
            $html = date('d/m/Y', strtotime($row->date));
            return $html;
        })
        ->addColumn('value', function($row){
            $class = $row->value < 0 ? 'text-danger' : 'text-success';
            $html = "<span class='$class'>R$ " . number_format($row->value, 2, ',', '.') . "</span>";
            return $html;
        })
        ->addColumn('wallet_credit', function($row){

            // SE FOR CARTEIRA
            if($row->has_wallet){
                $html = "
                    <span class='badge py-2 fw-bold fs-8 px-3' style='background: " . hex2rgb($row->wallet_color, 7) . "; color: " . $row->wallet_color . "'>
                        <i class='fa-solid fa-wallet fs-9 me-1' style='color: " . hex2rgb($row->wallet_color, 70) . "'></i>
                        $row->wallet_name
                    </span>";
            } else {
                $html = "<span class='badge badge-light-danger py-2 fw-bold fs-8 px-3'>
                            <div class='d-flex align-items-center'>
                                <i class='fa-solid fa-credit-card text-danger fs-9 me-1'></i>
                                <span>$row->card_name</span>
                            </div>
                        </span>";
            }

            return $html;
        })
        ->addColumn('actions', function($row){
            $html = "<a href='#' class='btn btn-light btn-active-light-primary btn-sm me-3'>
                        Ações
                    </a>";
            return $html;
        })
        ->rawColumns(['checked', 'name', 'category_id', 'date', 'value', 'wallet_credit', 'actions'])
        ->setTotalRecords($totalRecords)
        ->setFilteredRecords($pages->total())
        ->toJson();

    }
}
