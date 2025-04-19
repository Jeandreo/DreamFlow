<?php

namespace App\Http\Controllers;

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

        // REDIRECT AND MESSAGES
        return response()->json([
            'id' => $item->id,
            'name' => $item->item()->name,
            'quantity' => ($item->quantity ?? 1),
            'calories' => $item->getCalories(),
            'meal' => $meal->getTotalNutrient('calories'),
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
            ->route('diets.index')
            ->with('message', 'Dieta editado com sucesso.');

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
