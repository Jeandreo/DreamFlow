<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    
    protected $request;
    private $repository;
    
    public function __construct(Request $request, User $content)
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
        return view('pages.users.index')->with([
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
        // GET ALL DATA
        $users = User::where('status', 1)->get();

        // RENDER VIEW
        return view('pages.users.create')->with([
            'users' => $users,
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
        $data['password'] = Hash::make($request->password);

        // SEND DATA
        $created = $this->repository->create($data);
        
        // SAVE IMAGE
        if ($created && $request->cutImage) {
        
            // SET SIZES TO SAVE
            $sizes = [35, 300, 600, 1200];
        
            // DIRETORY
            $path = 'users/' . $created->id . '/';
        
            // RESIZE AND SAVE
            resizeAndSaveImage($request->cutImage, $sizes, 'perfil', $path);

        }

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('users.index')
                ->with('message', 'Usuário adicionado com sucesso.');

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
        $users = User::where('status', 1)->get();

        // VERIFY IF EXISTS
        if(!$content) return redirect()->back();

        // GENERATES DISPLAY WITH DATA
        return view('pages.users.edit')->with([
            'content' => $content,
            'users' => $users,
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

        // FORMAT PASSWORD
        if(isset($data['password'])){
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        
        // STORING NEW DATA
        $updated = $content->update($data);

        // SAVE IMAGE
        if ($updated && $request->cutImage) {
        
            // SET SIZES TO SAVE
            $sizes = [35, 300, 600, 1200];
        
            // DIRETORY
            $path = 'users/' . $id . '/';
        
            // RESIZE AND SAVE
            resizeAndSaveImage($request->cutImage, $sizes, 'perfil', $path);

        }

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('dashboard.index')
            ->with('message', 'Usuário editado com sucesso.');

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
            ->route('users.index')
            ->with('message', 'Usuário ' . $content->status == 1 ? 'desativado' : 'habilitado' . ' com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sidebar()
    {
        
        // GET DATA
        $content = User::find(Auth::id());
        $openOrClose = $content->sidebar == true ? false : true;
        $content->sidebar = $openOrClose;
        $content->save();

        // RETURN
        return response()->json('Success', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notes(Request $request)
    {
        
        // GET DATA
        $content = User::find(Auth::id());
        $content->notes = $request->notes;
        $content->save();

        // RETURN
        return response()->json('Success', 200);

    }

}
