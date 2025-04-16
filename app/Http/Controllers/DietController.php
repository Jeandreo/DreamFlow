<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;

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
    public function dashboard()
    {

        // GET ALL DATA
        $contents = $this->repository->orderBy('name', 'ASC')->get();        

        // RETURN VIEW WITH DATA
        return view('pages.diets.foods.index')->with([
            'contents' => $contents,
        ]);

    }
}
