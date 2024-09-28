<?php

namespace App\Http\Controllers\Product;

use App\Action\HandelMultiLangDataEncode;
use App\Events\SaveProductEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBaseController extends Controller
{

    protected $repo;
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $store_id)
    {
        return ProductResource::collection($this->repo->getAllPaginate($store_id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request, string $store_id)
    {
        $data = $request->validated();
        $data['store_id'] = $store_id;
        $data = HandelMultiLangDataEncode::handel($data,Product::$multiLangColumns);
        DB::beginTransaction();
        event(new SaveProductEvent($this->repo,$data));
        DB::commit();
        return ProductResource::make($this->repo->getOne('sku', $data['sku']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $store_id, string $id)
    {
        return $this->repo->getOne('id',$id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request,string $store_id, string $id)
    {
        $data = $request->validated();
        $data['store_id'] = $store_id;
        $data['id'] = $id;
        dd($data);
        $data = HandelMultiLangDataEncode::handel($data,Product::$multiLangColumns);
        DB::beginTransaction();
        event(new SaveProductEvent($this->repo,$data));
        DB::commit();
        return ProductResource::make($this->repo->getOne('sku', $data['sku']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
