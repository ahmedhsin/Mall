<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name',
        'description',
        'price',
        'stock',
        'status',
        'sku',
        'weight',
        'dimensions',
        'featured',
        'brand',
        'store_id',
        'user_id'
    ];

    public static $multiLangColumns = ['name', 'description', 'brand'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
