<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['size_name','size','status'];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'products_sizes', 'size_id', 'product_id');
    }
    public function productCount()
    {
        return $this->products()->count();
    }

    public function stock()
    {
        return $this->hasMany(Product_stock::class, 'size_id');
    }

    public function sizes()
    {
        $this->hasOne(SizeChart::class, 'size_id');
    }
}
