<?php

namespace App\Http\Controllers;

use App\Models\FinancialTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect()
                ->route('financial.index')
                ->with('message', 'Transação adicionada com sucesso.');

    }
}
