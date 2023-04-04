<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;


    public function products() {
        return $this->hasMany(Product::class);
    }

    public static function popular() {
        return self::withCount('products')->orderByDesc('products_count')->limit(5)->get();
    }
}
