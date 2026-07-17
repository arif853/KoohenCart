<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['brand_name', 'brand_image', 'slug', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            $brand->slug = Str::slug($brand->brand_name);
        });
    }
    public function product()
    {
        return $this->hasOne(Products::class, 'brand_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'brand_id');
    }
}
