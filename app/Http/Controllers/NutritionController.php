<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;

class NutritionController extends Controller
{
       
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        // RETURN VIEW WITH DATA
        return view('pages.nutrition.index')->with([
        ]);

    }
}
