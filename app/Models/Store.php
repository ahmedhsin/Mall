<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public static $multiLangColumns = ['name', 'description', 'address'];
    protected $fillable = ['name', 'description', 'address', 'phone', 'email','slug', 'manager_id'];
    public function logo()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
