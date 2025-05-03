<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Models\MealItem;
use App\Models\MealTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealItemController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, MealItem $content)
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
    public function index(Request $request)
    {

        // Obtém dieta ativa
        $diet = Diet::where('status', true)->first();

        // RETURN VIEW WITH DATA
        return view('pages.dashboard.meals._today')->with([
            'diet' => $diet,
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

        // Separa id do tipo
        $item = explode('_', $data['food_dish']);

        // Separa se for alimento ou prato
        if($item[0] == 'food'){
            $data['food_id'] = $item[1];
        } else {
            $data['dish_id'] = $item[1];
        }

        // Alimento
        $item = $this->repository->create($data);

        // Obtém calorias da refeição
        $meal = MealTime::find($data['meal_time_id']);

        // Renderiza o html
        $template = view('pages.nutrition.diets._template')->with('item', $item)->render();

        // REDIRECT AND MESSAGES
        return response()->json([
            'id' => $item->id,
            'html' => $template,
            'meal' => $meal->getTotalNutrient('calories'),
        ]);

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

        // Obtém calorias da refeição
        $meal = MealTime::find($content->meal_time_id);
        
        // Remove item
        $content->delete();

        // REDIRECT AND MESSAGES
        return response()->json($meal->getTotalNutrient('calories'));

    }

}
