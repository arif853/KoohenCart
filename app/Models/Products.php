<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory, Notifiable;

    protected $fillable =
    [
        'product_name',
        'brand_id',
        'category_id',
        'supplier_id',
        'subcategory',
        'raw_price',
        'regular_price',
        'offer_price',
        'description',
        'sku',
        'stock',
        'slug',
        'status',
        'is_sizechart',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($products) {
            $products->slug = Str::slug($products->product_name);
        });

        static::deleting(function ($product) {

            // Image/thumbnail files were never removed from disk on product delete
            // (only their DB rows, via cascade FKs), leaking storage on every
            // deleted product indefinitely.
            foreach ($product->product_images as $image) {
                Storage::disk('public')->delete('product_images/' . $image->product_image);
            }
            foreach ($product->product_thumbnail as $thumb) {
                Storage::disk('public')->delete('product_images/thumbnail/' . $thumb->product_thumbnail);
            }

            $product->overviews()->delete();
            $product->product_infos()->delete();
            $product->product_images()->delete();
            $product->product_thumbnail()->delete();
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

    /**
     * The price to actually charge/display: campaign price if this product is in
     * the currently published campaign, else the offer price if one is set, else
     * the regular price. Centralised here because six different places (cart,
     * wishlist, home, shop, new-products, product page) were each re-deriving this
     * with copy-pasted logic that silently 500'd when product_price was missing.
     */
    public function effectivePrice(): float
    {
        $regular = (float) ($this->regular_price ?? 0);

        $campaign = Campaign::where('status', 'Published')->first();
        if ($campaign) {
            $campProduct = $campaign->camp_product->firstWhere('product_id', $this->id);
            if ($campProduct) {
                return (float) $campProduct->camp_price;
            }
        }

        $offer = (float) ($this->product_price->offer_price ?? 0);

        return $offer > 0 ? $offer : $regular;
    }

    /**
     * The image shown on cart/wishlist lines: the lowest-id (i.e. first uploaded)
     * image, so it is stable across requests instead of whichever row the DB
     * happens to return first with no ORDER BY.
     */
    public function primaryImage(): ?Product_image
    {
        return $this->relationLoaded('product_images')
            ? $this->product_images->sortBy('id')->first()
            : $this->product_images()->oldest('id')->first();
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
        return $this->hasMany(Camp_product::class);
    }

        public function product_stocks()
    {
        return $this->hasMany(Product_stock::class, 'product_id');
    }

}
