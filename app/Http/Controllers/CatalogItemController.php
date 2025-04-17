<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\CatalogItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogItemController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, CatalogItem $content)
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
        return view('pages.catalogs_items.index')->with([
            'contents' => $contents,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // GET ALL DATA
        $catalog = Catalog::find($id);

        // RENDER VIEW
        return view('pages.catalogs_items.create')->with([
            'catalog' => $catalog,
        ]);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // GET FORM DATA
        $data = $request->all();

        // SET CATALOG
        $data['catalog_id'] = $id;

        // CREATED BY
        $data['created_by'] = Auth::id();
        
        // SEND DATA
        $created = $this->repository->create($data);

        // SAVE IMAGE
        if ($created && $request->cutImage) {
        
            // SET SIZES TO SAVE
            $sizes = [300, 600, 1200];
        
            // DIRETORY
            $path = 'catalogos/' . $id . '/' . $created->id . '/';
        
            // RESIZE AND SAVE
            resizeAndSaveImage($request->cutImage, $sizes, 'capa', $path);

        }

        // REDIRECT AND MESSAGES
        return redirect()
                ->route('catalogs.show', $id)
                ->with('message', 'Item adicionado com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // GET ALL DATA
        $contents = $this->repository->find($id);

        // RETURN VIEW WITH DATA
        return view('pages.catalogs_items.show')->with([
            'contents' => $contents,
        ]);
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
        return view('pages.catalogs_items.edit')->with([
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
        $update = $content->update($data);

        // SAVE IMAGE
        if ($update && $request->cutImage) {
        
            // SET SIZES TO SAVE
            $sizes = [300, 600, 1200];
        
            // DIRETORY
            $path = 'catalogos/' . $content->catalog_id . '/' . $id . '/';
        
            // RESIZE AND SAVE
            resizeAndSaveImage($request->cutImage, $sizes, 'capa', $path);

        }

        // REDIRECT AND MESSAGES
        return redirect()
            ->route('catalogs.items.show', $id)
            ->with('message', 'Item editado com sucesso.');

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
            ->route('catalogs.index')
            ->with('message', 'Catálogo ' . ($status == false ? 'desativado' : 'habilitado') . ' com sucesso.');

    }
}
