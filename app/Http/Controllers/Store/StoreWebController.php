<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreWebController extends StoreBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = parent::index();
        return Inertia::render('Stores/Index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Stores/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormRequest $request)
    {
        parent::store($request);
        return redirect()->route('stores.create')->with('message', 'Store Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = parent::show($id);
        return Inertia::render('Stores/Show',
            $data
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        app()->setLocale('all');
        $store = $this->repo->getOne('id', $id);
        return Inertia::render('Stores/Edit',
            [
                'store' => StoreResource::make($store)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFormRequest $request, string $id)
    {
        parent::update($request, $id);
        return redirect()->route('stores.show', $id)->with('message', 'Store Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
