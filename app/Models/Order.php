<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['products_price','shipping_address', 'billing_address', 'payment_method', 'notes', 'user_id', 'store_id'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }
}
