<?php

namespace App\Http\Controllers;

use App\Models\MealItem;
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
        $food = $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return response()->json([
            'id' => $food->id,
            'name' => $food->item()->name,
            'quantity' => $food->quantity,
            'calories' => $food->getCalories(),
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
        $status = $content->status == true ? false : true;

        // STORING NEW DATA
        $this->repository->where('id', $id)->update(['status' => $status, 'updated_by' => Auth::id()]);

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('diets.index')
            ->with('message', 'Dieta ' . ($status == false ? 'desativado' : 'habilitado') . ' com sucesso.');

    }

}
