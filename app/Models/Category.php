<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_id',
        'category_name',
        'parent_category',
        'category_icon',
        'category_image',
        'slug',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->category_name);
        });
    }
    public function product()
    {
        // Was hasMany(..., 'product_id') - products has no such column (it has
        // category_id pointing here), so this relation could never match anything.
        return $this->hasMany(Products::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category', 'category_name');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category', 'category_name');
    }

    public function categorySizeHeaders()
    {
        return $this->hasMany(CategorySizeHeader::class, 'category_id');
    }
}
