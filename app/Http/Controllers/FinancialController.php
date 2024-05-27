<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\FinancialCategory;
use App\Models\FinancialWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class FinancialController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, Financial $content)
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

        // Atualizando o array de séries para incluir as tarefas concluídas
        $series = [
            [
                'name' => 'Entrada',
                'data' => array_values([800.00,850.50,900.75,950.20,1000.00,1100.45,1200.90,1300.35,1500.00,1750.80,1900.25,2000.00]),
            ],
            [
                'name' => 'Saída',
                'data' => array_values([810.25,860.40,920.55,980.75,1050.10,1150.65,1250.30,1350.90,1600.45,1800.85,1950.70,1999.99]),
            ],
        ];

        return view('pages.financial.index')->with([
            'wallets' => $wallets,
            'categories' => $categories,
            'series' => $series,
            'monthNames' => array_values($monthNames),
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

        // JOIN FIND FATHER
        $query->leftJoin('financial_categories as category_father', function($join) {
            $join->on('category_father.id', '=', 'financial_categories.category_id');
        });

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
                $query->where('users.name', 'like', "%$request->searchBy%")
                        ->orWhere('suppliers.name', 'like', "%$request->searchBy%")
                        ->orWhere('clients.name', 'like', "%$request->searchBy%");
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
                
                case 'date_venciment':
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

        // ITENS PER PAGE AND PAGINATE
        $pages = $query->paginate($request->per_page);

        $query->select(
            'financial_transactions.id as id',
            'financial_transactions.name as name',
            'financial_transactions.date_venciment as date',
            'financial_transactions.value as value',
            'financial_categories.name as category',
            'financial_categories.category_id as has_father',
            'financial_categories.color as category_color',
            'category_father.name as father_name',
            'category_father.color as father_color',
        );

        // MAKE COLUMNS
        return FacadesDataTables::of($query)
        ->addColumn('checked', function($row){
            $html = "<div class='form-check form-check-sm form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' value='$row->id'>
                    </div>";
            return $html;
        })
        ->addColumn('name', function($row){
            $html = "$row->name";
            return $html;
        })
        ->addColumn('category_id', function($row){

            // VERIFY IF HAS FATHER
            $color = $row->has_father ? $row->father_color : $row->category_color;

            $html = "<a href='#' class='d-flex align-items-center fs-6 fw-normal'>
                        <div class='w-25px h-25px rounded-circle d-flex justify-content-center align-items-center me-2' style='background: $color;'>
                            <i class='fa-solid fa-home fs-7 text-white'></i>
                        </div>
                        <span class='text-gray-600 text-hover-primary'>
                        $row->category
                        </span>
                    </a>";
            return $html;
        })
        ->addColumn('date', function($row){
            $html = date('d/m/Y', strtotime($row->date));
            return $html;
        })
        ->addColumn('value', function($row){
            $class = $row->value < 0 ? 'text-danger' : 'text-success';
            $html = "<span class='$class'>R$ " . number_format($row->value, 2, ',', '.') . "";
            return $html;
        })
        ->addColumn('actions', function($row){
            $html = "<a href='#' class='btn btn-light btn-active-light-primary btn-sm'>
                        Ações
                    </a>";
            return $html;
        })
        ->rawColumns(['checked', 'name', 'category_id', 'date', 'value', 'actions'])
        ->setTotalRecords($totalRecords)
        ->setFilteredRecords($pages->total())
        ->toJson();

    }

}
