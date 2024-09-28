<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->user()->id)->paginate(10);
        return Inertia::render('Orders/Orders', [
            "orders" => $orders
        ]);
    }

    public function orders(string $store_id)
    {
        $orders = Order::query()->where('store_id', $store_id)->paginate(10);
        return Inertia::render('Dashboards/Store/Order', [
            "orders" => $orders
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

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::query()->with('products')->where('id', $id)->first();
        return Inertia::render('Orders/Order.Show', [
            "order" => OrderResource::make($order),
        ]);
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
