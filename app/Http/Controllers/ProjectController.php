<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, Project $content)
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
        return view('pages.projects.index', [
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

        // GET ALL DATA
        return view('pages.projects.create');

    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // VERIFY IF TITLE IS UNIQUE
        $existName = $this->repository->where('name', $request->name)->exists();

        // IF EXISTS
        if($existName){
            // REDIRECT AND MESSAGES
            return redirect()
                ->route('core.ink.brands.create')
                ->with('message', 'A marca <b>'. $request->name . '</b> já existe.');
        }

        // GET FORM DATA
        $data = $request->all();

        // CREATED BY
        $data['created_by'] = Auth::id();
        
        // SEND DATA
        $insertTable = $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('core.projects.index')
                ->with('message', 'Projeto <b>'. $insertTable->name . '</b> adicionado com sucesso.');

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
        if(!$content){
            return redirect()->back();
        }

        // GENERATES DISPLAY WITH DATA
        return view('pages.projects..edit')->with(['content' => $content]);
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

        // VERIFY IF TITLE IS UNIQUE
        $existName = $this->repository->where('name', $request->name)->where('id', '!=', $id)->count();
        if($existName > 0){
            // REDIRECT AND MESSAGES
            return redirect()
            ->route('core.ink.brands.edit', $id)
            ->with('message', 'A marca <b>'. $request->name . '</b> já existe.');
        }

        // VERIFY IF EXISTS
        if(!$content = $this->repository->find($id))
        return redirect()->back();

        // GET FORM DATA
        $data = $request->all();

        // UPDATE BY
        $data['updated_by'] = Auth::id();
        
        // STORING NEW DATA
        $content->update($data);

        // REDIRECT AND MESSAGES
        return redirect()
        ->route('core.ink.brands.edit', $id)
        ->with('message', 'Marca <b>'. $request->name . '</b> atualizada com sucesso.');

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

        // STORING NEW DATA
        if($content->status == 1){
            $this->repository->where('id', $id)->update(['status' => 0, 'filed_by' => Auth::id()]);
            $message = 'desabilitada';
        } else {
            $this->repository->where('id', $id)->update(['status' => 1]);
            $message = 'habilitada';
        }
        

        // REDIRECT AND MESSAGES
        return redirect()
        ->route('core.ink.brands.index')
        ->with('message', 'Marca <b>'. $content->name . '</b> '. $message .' com sucesso.');

    }
}
