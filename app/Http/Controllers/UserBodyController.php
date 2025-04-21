<?php

namespace App\Http\Controllers;

use App\Models\UserBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBodyController extends Controller
{
    
    protected $request;
    private $repository;
    
    public function __construct(Request $request, UserBody $content)
    {
        
        $this->request = $request;
        $this->repository = $content;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // GET ALL DATA
        $lastBody = $this->repository
                        ->where('user_id', Auth::id())
                        ->latest('created_at')
                        ->first();
        
        // GENERATES DISPLAY WITH DATA
        return view('pages.nutrition.body.edit')->with([
            'lastBody' => $lastBody,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // GET FORM DATA
        $data = $request->all();

        // UPDATE BY
        $data['user_id'] = Auth::id();
        
        // STORING NEW DATA
        $body = $this->repository->create($data);

        $body->calculateBmr();

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('body.edit')
            ->with('message', 'Medidas do corpo atualizadas com sucesso.');

    }
}
