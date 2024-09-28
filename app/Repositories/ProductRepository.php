<?php

namespace App\Repositories;

use App\Filters\CategorySlugFilter;
use App\Models\Product;
use Illuminate\Pipeline\Pipeline;

class ProductRepository
{
    public function getAllPaginate($store_id, $filters=[])
    {
        $products = Product::query()->
        with(['categories', 'images'])->where('store_id', '=', $store_id);
        foreach ($filters as $val){
            $products = $products->where($val['key'], $val['op'], $val['value']);
        }
        $res = app(Pipeline::class)
            ->send($products)
            ->through([
            ])
            ->thenReturn()
            ->paginate(10);
        return $res;
    }
    public function getOne($value,$key)
    {
        return Product::query()->with(['categories', 'images'])->where($value,'=',$key)->first();
    }

    public function updateOrCreate($id, $data)
    {
        return Product::query()->updateOrCreate(["id"=>$id], $data);
    }
}
