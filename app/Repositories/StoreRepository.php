<?php

namespace App\Repositories;

use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Services\Messages;
use Illuminate\Pipeline\Pipeline;

class StoreRepository
{

    public function getAllPaginate()
    {
        $stores = Store::query()->with('logo');
        $res = app(Pipeline::class)
            ->send($stores)
            ->through([
                /*NameFilter::class,
                PhoneFilter::class,
                StartDateFilter::class,
                EndDateFilter::class,*/
            ])
            ->thenReturn()
            ->paginate(10);
        return $res;
    }
    public function getOne($value,$key)
    {
        $store = Store::query()->with('logo')->where($value,'=',$key)->first();
        return $store;
    }

    public function updateOrCreate($id, $data)
    {
        return Store::query()->updateOrCreate(["id"=>$id], $data);
    }
}
