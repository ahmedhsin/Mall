<?php

namespace App\Http\Controllers\DashBoard\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreDashboardWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        return Inertia::render('Dashboards/Store/Index');
    }

    public function all()
    {
        $stores = Store::query()->with('logo')->paginate(10);
        return Inertia::render('Dashboards/Dashboard',[
            "stores" => StoreResource::collection($stores)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
