<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_price extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','offer_price','percentage','amount','offer_type'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
