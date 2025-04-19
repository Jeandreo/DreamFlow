<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, Food $content)
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
        return view('pages.nutrition.foods.index')->with([
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
        return view('pages.nutrition.foods.create');
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
                ->route('foods.index')
                ->with('message', 'Alimento adicionado com sucesso.');

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
        return view('pages.nutrition.foods.edit')->with([
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
        $content->update($data);

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('foods.index')
            ->with('message', 'Alimento editado com sucesso.');

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
            ->route('foods.index')
            ->with('message', 'Alimento ' . ($status == false ? 'desativado' : 'habilitado') . ' com sucesso.');

    }

    public function food(Request $request)
    {

        // Obtém dados do formul´årio
        $data = $request->all();

        // Ajusta o valor eaten
        $data['eaten'] = $data['eaten'] == 'true' ? true : false;

        $log = FoodLog::updateOrCreate(
            [
                'food_id' => $data['itemId'],
                'date' => date('Y-m-d'),
            ],
            [
                'eaten' => $data['eaten'],
            ]
        );
    
        return response()->json($log);
    }

}
