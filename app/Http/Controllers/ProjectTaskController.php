<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectTask;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectTaskController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, ProjectTask $content)
    {
        
        $this->request = $request;
        $this->repository = $content;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // GET ALL DATA
        $contents = Project::orderBy('name', 'ASC');
        $contents = $request->project_id == 0 ? $contents : $contents->where('id', $request->project_id);
        $contents = $contents->get(); 

        $users = User::where('status', 1)->get();

        // RETURN VIEW WITH DATA
        return view('pages.tasks.index')->with([
            'contents' => $contents,
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
        $data['date']           = now();
        $data['created_by']     = Auth::id();
        $data['designated_id']  = Auth::id();
        
        // SEND DATA
        $created = $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return response()->json($created->toArray(), 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // GET ALL DATA
        $contents = $this->repository->find($request->task_id);

        // RETURN VIEW WITH DATA
        return view('pages.tasks.show')->with([
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

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.tasks.edit')->with([
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
        $updated = $content->update($data);

        // SAVE AND RENAME IMAGE
        if($updated && $request->hasFile('image')){
            $request->file('image')->storeAs('public/images', $id . '.jpg');
        }

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('projects.edit', $id)
            ->with('message', 'Projeto editado com sucesso.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAjax(Request $request, $id)
    {

        // VERIFY IF EXISTS
        if(!$content = $this->repository->find($id))
        return redirect()->back();

        // GET FORM DATA
        $data = $request->all();

        // UPDATE VALUE
        $data[$request->input] = $request->value;

        // UPDATE BY
        $data['updated_by'] = Auth::id();
        
        // STORING NEW DATA
        $content->update($data);

        // REDIRECT AND MESSAGES
        return response()->json('Success', 200);

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
        $status = $content->status == 1 ? 0 : 1;

        // STORING NEW DATA
        $this->repository->where('id', $id)->update(['status' => $status, 'updated_by' => Auth::id()]);

        // REDIRECT AND MESSAGES
        return redirect()
            ->back()
            ->with('message', 'Tarefa ' . $content->status == 1 ? 'desativado' : 'habiliitado' . ' com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function standBy($id)
    {
        
        // STORING NEW DATA
        $this->repository->where('id', $id)->update(['status' => 2, 'updated_by' => Auth::id()]);

        // REDIRECT AND MESSAGES
        return redirect()
            ->back()
            ->with('message', 'Tarefa em stand-by.');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax($id)
    {

        // GET ALL DATA
        $tasks = ProjectTask::where('project_id', $id)->whereNull('task_id')->where('status', 1)->where('checked', 0)->orderBy('order', 'ASC')->orderBy('updated_at', 'DESC')->get();
        $users = User::where('status', 1)->get();

        // RETURN VIEW WITH DATA
        return view('pages.tasks._tasks')->with([
            'tasks' => $tasks,
            'users' => $users,
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {

        // GET ALL DATA
        $contents = ProjectTask::find($request->task_id);

        // MARK AS CHECK
        $check = $contents->checked == true ? false : true;

        // SAVE
        $contents->checked = $check;
        $contents->checked_at = now();
        $contents->save();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function priority(Request $request)
    {

        // GET ALL DATA
        $contents = ProjectTask::find($request->task_id);

        // MARK AS CHECK
        $priority = $contents->priority;

        // SET PRIORITY
        if($priority <= 2){
            $newPriority = $priority + 1;
        } else {
            $newPriority = 0;
        } 

        // SAVE
        $contents->priority = $newPriority;
        $contents->save();

        return response()->json($contents->priority, 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function designated(Request $request)
    {

        // GET ALL DATA
        $contents = ProjectTask::find($request->task_id);

        // MARK AS CHECK
        $contents->designated_id = $request->designated_id;
        $contents->save();

        // GET IMAGE
        $img = findImage('users/' . $request->designated_id . '/' . 'perfil-35px.jpg');

        // RETURN
        return response()->json($img, 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {

        // UPDATE TASK STATUS
        $content = ProjectTask::find($request->task_id);
        $content->status_id = $request->status_id;
        $content->save();

        // STATUS
        $status = ProjectStatus::find($request->status_id);

        // RETURN
        return response()->json([
            "name" => $status->name,
            "color" => $status->color,
        ], 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function date(Request $request)
    {

        // UPDATE TASK STATUS
        $content = ProjectTask::find($request->task_id);
        $content->date = $request->date;
        $content->save();

        // RETURN
        return response()->json('Sucesso', 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {

        // START POSITION 0
        $position = 0;

        // GET TASK
        $task = ProjectTask::find($request->task_id);
        $startProject = $task->project_id;
        $task->project_id = $request->project_id;
        $task->save();

        // PROJECT
        $project = Project::find($request->project_id);

        // SAVE NEW ORDER
        foreach($request->tasksOrderIds as $id){
            // STORING NEW DATA
            $content = ProjectTask::find($id);
            $content->order = $position;
            $content->save();

            // SAVE NEXT POSITION
            ++$position;
        }

        // RETURN
        return response()->json(['color' => $project->color, 'startProject' => $startProject], 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subtask(Request $request)
    {

        // GET TASK
        $created = ProjectTask::create([
            'task_id' => $request->task_id,
            'project_id' => $request->project_id,
            'designated_id' => Auth::id(),
            'created_by' => Auth::id(),
        ]);

        // GET USERS
        $users = User::where('status', 1)->get();
        $task = ProjectTask::find($created->id);

        // RETURN VIEW WITH DATA
        return view('pages.tasks._subtask')->with([
            'subtask' => $task,
            'users' => $users,
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkeds(Request $request)
    {

        // GET ALL DATA
        $contents = ProjectTask::where('project_id', $request->project_id)->where('checked', true)->get();

        // RETURN VIEW WITH DATA
        return view('pages.tasks._checkeds')->with([
            'contents' => $contents,
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function challenge(Request $request)
    {

        $task = ProjectTask::find($request->task_id);
        $task->challenge = $request->checked == 'true' ? true : false;
        $task->save();

        return response()->json($request->all(), 200);

    }

}
