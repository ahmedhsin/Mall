<?php

namespace App\Http\Controllers\Category;

use App\Action\HandelMultiLangDataEncode;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $repo;
    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index(string $id)
    {
        return CategoryResource::collection($this->repo->getAll($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormRequest $request, string $store_id)
    {
        $data = $request->validated();
        $data['store_id'] =$store_id;
        $data = HandelMultiLangDataEncode::handel($data, Category::$multiLangColumns);
        $this->repo->updateOrCreate(null, $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repo->getOne('id',$id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormRequest $request, string $id)
    {
        $data = $request->validated();
        $this->repo->updateOrCreate($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
