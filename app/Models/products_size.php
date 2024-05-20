<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_size extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','size_id'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
