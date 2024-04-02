<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Products extends Model
{
    use HasFactory,Notifiable;

    protected $fillable =
    [
        'product_name',
        'brand_id',
        'category_id',
        'subcategory',
        'raw_price',
        'regular_price',
        'offer_price',
        'description',
        'sku',
        'stock',
        'slug',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($products) {
            $products->slug = Str::slug($products->product_name);
        });

        static::deleting(function ($product) {

            $product->overviews()->delete();
            $product->product_infos()->delete();
            $product->product_images()->delete();
            $product->product_extras()->delete();
            $product->product_price()->delete();
            $product->tags()->delete();
            $product->sizes()->detach();
            $product->colors()->detach();
            // $product->brand()->delete();
            // $product->category()->delete();
            // $product->subcategory()->delete();

        });
    }

    public function overviews()
    {
        return $this->hasMany(Product_overview::class, 'product_id');
    }
    public function product_infos()
    {
        return $this->hasMany(Product_additionalinfo::class, 'product_id');
    }

    public function product_images()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }

    public function product_thumbnail()
    {
        return $this->hasMany(Product_thumbnail::class, 'product_id');
    }

    public function product_extras()
    {
        return $this->hasMany(Product_extra::class, 'product_id');
    }

    public function product_price()
    {
        return $this->hasOne(Product_price::class, 'product_id');
    }

    public function tags()
    {
        return $this->hasMany(Product_tag::class, 'product_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'products_sizes', 'product_id', 'size_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'products_colors', 'product_id', 'color_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function order_item()
    {
        return $this->hasMany(order_items::class, 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function camp_product()
    {
        return $this->hasMany(Camp_product::class, 'product_id');
    }

    public function product_stocks()
    {
        return $this->hasMany(Product_stock::class, 'product_id');
    }

    // public function featureItem()
    // {
    //     return $this->belongsTo(FeatureProducts::class, 'feature_products_id', 'feature_products_with_pivot' );
    // }

}
