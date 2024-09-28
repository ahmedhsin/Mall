<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public static $multiLangColumns = ['name'];
    protected $fillable = ['name', 'store_id', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
