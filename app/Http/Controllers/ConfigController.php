<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select2Options(Request $request)
    {
        $term = $request->term;
        $results = [];

        // Buscar alimentos
        $foods = Food::where('status', 1)
                    ->where('name', 'LIKE', $term . '%')
                    ->limit(10)
                    ->get();

        foreach ($foods as $item) {
            $results[] = [
                'id' => 'food_' . $item->id,
                'text' => "{$item->name} " . round($item->calories) . "kcal",
            ];
        }

        // Buscar pratos
        $dishes = Dish::where('status', 1)
                        ->where('name', 'LIKE', $term . '%')
                        ->limit(10)
                        ->get();

        foreach ($dishes as $item) {
            $results[] = [
                'id' => 'dish_' . $item->id,
                'text' => Str::limit($item->name, 18) . " {$item->getTotalCaloriesAttribute()} kcal",
            ];
        }

        return response()->json($results);
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function CKEupload(Request $request)
    {

        // FORMAT FILE TO STORE        
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;

        // STORE FILE
        $request->file('upload')->storeAs('public/media', $fileName);

        // RETURN URL
        $url = asset('storage/media/' . $fileName);

        // RETURN
        return response()->json([
            'fileName' => $fileName, 
            'uploaded' => 1, 
            'url' => $url
        ]);

    }
}
