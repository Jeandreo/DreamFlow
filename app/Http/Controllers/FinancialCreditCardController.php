<?php

namespace App\Http\Controllers;

use App\Models\FinancialCreditCard;
use App\Models\FinancialWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialCreditCardController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, FinancialCreditCard $content)
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
        return view('pages.financial_credit.index')->with([
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
        $wallets = FinancialWallet::where('status', 1)->get();

        // RENDER VIEW
        return view('pages.financial_credit.create')->with([
            'wallets' => $wallets,
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

        // FORMAT DATA
        $data['limit'] = toDecimal($data['limit']);

        // CREATED BY
        $data['created_by'] = Auth::id();
        
        // SEND DATA
        $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('financial.credit.cards.index')
                ->with('message', 'Cartão adicionado com sucesso.');

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

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.financial_credit.edit')->with([
            'content' => $content,
            'wallets' => $wallets,
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

        // FORMAT DATA
        $data['limit'] = toDecimal($data['limit']);

        // UPDATE BY
        $data['updated_by'] = Auth::id();
        
        // STORING NEW DATA
        $content->update($data);

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('financial.credit.cards.index')
            ->with('message', 'Cartão editado com sucesso.');

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
            ->route('financial.credit.cards.index')
            ->with('message', 'Cartão ' . ($status == false ? 'desativado' : 'habiliitado') . ' com sucesso.');

    }
}
