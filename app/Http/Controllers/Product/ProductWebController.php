<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductWebController extends ProductBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $store_id)
    {
        $data = parent::index($store_id);
        return Inertia::render('Dashboards/Store/Product',
            [
                "products" => $data,
            ]);
    }

    public function products(string $store_id)
    {
        $data = ProductResource::collection($this->repo->getAllPaginate($store_id, [[
            "key" => "status",
            "op" => "=",
            "value" => "active"
        ],[
            "key" => "stock",
            "op" => ">",
            "value" => 0
        ]
            ]));
        return Inertia::render('Client/Index.Product',
            [
                "products" => $data,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $store_id)
    {
        $data = parent::index($store_id);
        $categories = new CategoryRepository();
        $categories = $categories->getAll($store_id);
        return Inertia::render('Dashboards/Store/Product.Create',
            [
                "products" => $data,
                "categories" => CategoryResource::collection($categories)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request, string $store_id)
    {
        parent::store($request, $store_id);
        return back()->with('message', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $store_id, string $id)
    {
        $data = parent::show($store_id, $id);
        return Inertia::render('Client/Show.Products',
            [
                "product" => ProductResource::make($data),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $store_id, string $id)
    {
        //issue in update that each [i need get product with all lang]
        $product = $this->repo->getOne('id', $id);
        $product->categories;
        $product->images;
        $categories = new CategoryRepository();
        $categories = $categories->getAll($store_id);
        $product = ProductResource::make($product);
        $categories = CategoryResource::collection($categories);
        return Inertia::render('Dashboards/Store/Product.Edit',
            [
                "product" => $product,
                "categories" => $categories
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request,string $store_id, string $id)
    {
        parent::update($request, $store_id, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
