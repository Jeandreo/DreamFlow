<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\User;
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
        return view('pages.projects.index')->with([
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
        $users = User::where('status', 1)->get();

        // RENDER VIEW
        return view('pages.projects.create')->with([
            'users' => $users,
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
        $created = $this->repository->create($data);

        if($created){
            ProjectStatus::create([
                'name' => 'A Fazer',
                'color' => '#009ef7',
                'project_id' => $created->id,
                'order' => 1,
                'created_by' => 1,
            ]);

            ProjectStatus::create([
                'name' => 'Em andamento',
                'color' => '#79bc17',
                'project_id' => $created->id,
                'order' => 1,
                'created_by' => 1,
            ]);

            ProjectStatus::create([
                'name' => 'Concluído',
                'color' => '#282c43',
                'project_id' => $created->id,
                'order' => 1,
                'created_by' => 1,
            ]);
        }

        // SAVE AND RENAME IMAGE
        if($created && $request->hasFile('image')){
            $request->file('image')->storeAs('public/projetos/' . $created->id, 'capa.jpg');
        }

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('projects.index')
                ->with('message', 'Projeto adicionado com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        // GET ALL DATA
        $contents = $this->repository->find($id);
        $users = User::where('status', 1)->get();

        // RETURN VIEW WITH DATA
        return view('pages.projects.show')->with([
            'contents' => $contents,
            'users' => $users,
            'noHeader' => true,
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
        $users = User::where('status', 1)->get();

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.projects.edit')->with([
            'content' => $content,
            'users' => $users,
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
        $updated = $content->update($data);

        // SAVE AND RENAME IMAGE
        if($updated && $request->hasFile('image')){
            $request->file('image')->storeAs('public/projetos/' . $id, 'capa.jpg');
        }

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('projects.edit', $id)
            ->with('message', 'Projeto editado com sucesso.');

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
            ->route('projects.index')
            ->with('message', 'Projeto ' . ($status == false ? 'desativado' : 'habiliitado') . ' com sucesso.');

    }

}
