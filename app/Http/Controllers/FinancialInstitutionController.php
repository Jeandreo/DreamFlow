<?php

namespace App\Http\Controllers;

use App\Models\FinancialInstitution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialInstitutionController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, FinancialInstitution $content)
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
        $contents = $this->repository->orderBy('name', 'ASC')->get();

        // RETURN VIEW WITH DATA
        return view('pages.financial_institutions.index')->with([
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

        // RENDER VIEW
        return view('pages.financial_institutions.create');
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
        $created = $this->repository->create($data);

        // SAVE IMAGE
        if ($created && $request->cutImage) {
        
            // SET SIZES TO SAVE
            $sizes = [50, 100, 150, 300, 600, 1200];
        
            // DIRETORY
            $path = 'instituicoes/' . $created->id . '/';
        
            // RESIZE AND SAVE
            resizeAndSaveImage($request->cutImage, $sizes, 'logo', $path);

        }

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('financial.institutions.index')
                ->with('message', 'Instituição adicionada com sucesso.');

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

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.financial_institutions.edit')->with([
            'content' => $content,
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
        
        // STORING NEW DATA
        $update = $content->update($data);

        // SAVE IMAGE
        if ($update && $request->cutImage) {
        
            // SET SIZES TO SAVE
            $sizes = [50, 100, 150, 300, 600, 1200];
        
            // DIRETORY
            $path = 'instituicoes/' . $id . '/';
        
            // RESIZE AND SAVE
            resizeAndSaveImage($request->cutImage, $sizes, 'logo', $path);

        }

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('financial.institutions.index')
            ->with('message', 'Instituição editada com sucesso.');

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
            ->route('financial.institutions.index')
            ->with('message', 'Instituição ' . ($status == false ? 'desativada' : 'habiliitada') . ' com sucesso.');

    }
}
