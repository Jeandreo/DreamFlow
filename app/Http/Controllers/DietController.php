<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, Diet $content)
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
        return view('pages.nutrition.diets.index')->with([
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
        $meals = Meal::where('status', true)->get();
        return view('pages.nutrition.diets.create')->with([
            'meals' => $meals,
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
        $meal = $this->repository->create($data);

        // SYNC meals (without pivot data)
        $meal->meals()->sync($request->input('meals'));

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('diets.index')
                ->with('message', 'Deita adicionado com sucesso.');

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
        return view('pages.nutrition.diets.show')->with([
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
        $meals = Meal::where('status', true)->get();

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.nutrition.diets.edit')->with([
            'content' => $content,
            'meals' => $meals,
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
        $content->update($data);

        // SYNC meals (without pivot data)
        $content->meals()->sync($request->input('meals', []));

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('diets.index')
            ->with('message', 'Deita editado com sucesso.');

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
            ->route('diets.index')
            ->with('message', 'Deita ' . ($status == false ? 'desativado' : 'habilitado') . ' com sucesso.');

    }

}
