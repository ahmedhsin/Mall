<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Pipeline\Pipeline;

class CategoryRepository
{
    public function getAll(string $store_id)
    {
        $categories = Category::query()->where('store_id', '=', $store_id);
        return app(Pipeline::class)
            ->send($categories)
            ->through([
                /*NameFilter::class,
                PhoneFilter::class,
                StartDateFilter::class,
                EndDateFilter::class,*/
            ])
            ->thenReturn()
            ->get();
    }
    public function getOne($value,$key)
    {
        return Category::query()->where($value,'=',$key)->first();
    }


    public function updateOrCreate($id, $data)
    {
        return Category::query()->updateOrCreate(["id"=>$id], $data);
    }

    public function addCategoriesToProduct($categories_ids, $product_id)
    {
        foreach ($categories_ids as $category_id){
            CategoryProduct::query()->create([
                'category_id' => $category_id,
                'product_id' => $product_id
            ]);
        };
        return true;
    }
}
