<?php

namespace App\Http\Controllers;

use App\Models\FinancialInstitution;
use App\Models\FinancialTransactions;
use App\Models\FinancialWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialWalletController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, FinancialWallet $content)
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

        // GET ALL DATA
        $contents = $this->repository->orderBy('name', 'ASC')->where('created_by', Auth::id())->get();

        // RETURN VIEW WITH DATA
        return view('pages.financial_wallets.index')->with([
            'contents' => $contents,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // GET DATA
        $institutions = FinancialInstitution::where('status', 1)->get();

        // RENDER VIEW
        return view('pages.financial_wallets.create')->with([
            'institutions' => $institutions,
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
        
        // SEND DATA
        $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('financial.wallets.index')
                ->with('message', 'Carteira adicionada com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // GET ALL DATA
        $contents = $this->repository->find($id);

        // RETURN VIEW WITH DATA
        return view('pages.financial_wallets.show')->with([
            'contents' => $contents,
        ]);
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
        $institutions = FinancialInstitution::where('status', 1)->get();

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.financial_wallets.edit')->with([
            'content' => $content,
            'institutions' => $institutions,
        ]);
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

        // UPDATE BY
        $data['updated_by'] = Auth::id();

        // Corrige o valor da carteira caso necessário
        $actualAmount = $content->total();
        $newAmount = toDecimal($request->balance);
        
        // Se for diferente
        if($actualAmount != $newAmount){

            // Obtém diferença
            $diference = $actualAmount - $newAmount;

            // Inverte o sinal
            $diference = -$diference;

            // Cria transação de diferença no banco de dados
            FinancialTransactions::create([
                'wallet_id' => $id,
                'category_id' => 0,
                'name' => $content->name,
                'adjustment' => true,
                'value' => $diference,
                'value_paid' => $diference,
                'paid' => true,
                'date_purchase' => now(),
                'date_payment' => now(),
                'date_paid' => now(),
                'created_by' => Auth::id(),
            ]);

        }

        
        // STORING NEW DATA
        $content->update($data);

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('financial.wallets.index')
            ->with('message', 'Carteira editada com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // GET DATA
        $content = $this->repository->find($id);
        $status = $content->status == true ? false : true;

        // STORING NEW DATA
        $this->repository->where('id', $id)->update(['status' => $status, 'updated_by' => Auth::id()]);

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('financial.wallets.index')
            ->with('message', 'Carteira ' . ($status == false ? 'desativada' : 'habiliitada') . ' com sucesso.');

    }
}
