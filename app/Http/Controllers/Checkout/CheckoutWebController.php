<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CheckoutWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Orders/Checkout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = $request->all();
        $products_data = array_reduce($data['products_ids'], function ($ac , $prod){
            $ac[$prod['id']] = $prod['quantity'];
            return $ac;
        }, []);


        $products =  Product::query()->whereIn('id', array_keys($products_data))->get()->toArray();
        $products_price = array_reduce($products, function ($accumulator, $product) use ($products_data) {
            return $accumulator + $product['price'] * $products_data[$product['id']];
        }, 0);

        /**order created*/
        $order = Order::query()->create([
            "products_price" => $products_price,
            "billing_address" => $data['billing_address'],
            "payment_method" => $data['payment_method'],
            "shipping_address" => $data['shipping_address'],
            "notes" => $data['notes'],
            "user_id" => auth()->user()->id,
            "store_id" => $products[0]['store_id']
        ]);

        /**add products to order**/

        $products = array_reduce($products, function ($ac, $prod){
            $ac[$prod['id']] = $prod;
            return $ac;
        }, []);
        foreach ($products_data as $id => $quantity){
            $product = Product::query()->where('id', $id)->first();
            if ($product->stock < $quantity){
                return back()->with('error', 'Something wrong please try to clear the cache or decrease the amount of the product');
            }
            $product->decrement('stock', $quantity);
            OrderProduct::query()->create([
               "product_id" => $id,
               "order_id" => $order->id,
               "quantity" => $quantity,
               "price" => array_column(array_filter($products, function ($product) use ($id) {
                   return $product['id'] == $id;
               }), "price")[0]
            ]);
        }
        DB::commit();

        return redirect('/orders');
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
