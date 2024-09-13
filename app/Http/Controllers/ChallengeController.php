<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, Challenge $content)
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
        return view('pages.challenges.index')->with([
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
        return view('pages.challenges.create');
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

        // MONTH OR WEEK
        if($data['type'] == 'mensal'){
            $data['date'] = str_pad($request->month , 2 , '0' , STR_PAD_LEFT) . '/' . $request->year;
        } else {

            // SEPARE DATES
            $week = explode(' até ', $data['days_week']);

            // SAVE CUSTOM
            $data['custom_start'] = $request->year . $week[0];
            $data['custom_end'] = $request->year . $week[1];

        }

        // SEND DATA
        $this->repository->create($data);

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('challenges.index')
                ->with('message', 'Desafio adicionado com sucesso.');

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
        return view('pages.challenges.edit')->with([
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

        // MONTH OR WEEK
        if($data['type'] == 'mensal'){
            $data['date'] = str_pad($request->month , 2 , '0' , STR_PAD_LEFT) . '/' . $request->year;
        } else {

            if($data['days_week']){
                // SEPARE DATES
                $week = explode(' até ', $data['days_week']);

                // SAVE CUSTOM
                $data['custom_start'] = $request->year . $week[0];
                $data['custom_end'] = $request->year . $week[1];
            }

        }
        
        // STORING NEW DATA
        $content->update($data);

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('dashboard.index')
            ->with('message', 'Desafio editado com sucesso.');

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
            ->route('challenges.index')
            ->with('message', 'Desafio ' . $content->status == 1 ? 'desativado' : 'habiliitado' . ' com sucesso.');

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {

        // GET FORM DATA
        $data = $request->all();

        // FORMAT DATE
        $newDate = date('Y-m-' . str_pad($data['day'], 2, '0', STR_PAD_LEFT));

        // FIND RESULT
        $day = ChallengeCompleted::where('date', $newDate)->where('type', $data['type'])->first();

        // IF NO EXISTS
        if($day == null){

            // SET STATUS
            $status = true;

            // SCREATE
            ChallengeCompleted::create([
                'date' => $newDate,
                'completed' => true,
                'challenge_id' => $data['challenge'],
                'type' => $data['type'],
                'created_by' => Auth::id(), 
            ]);
        } else {

            // VERIFY AND UPDATE
            $status = $day->completed == true ? false : true;
            $day->completed = $status;
            $day->save();


        }

        // RESPONSE
        return response()->json([$status], 200);

    }

}
