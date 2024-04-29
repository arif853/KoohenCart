<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'offer_name',
        'offer_type_id',
        'offer_percent',
        'to_date',
        'from_date',
        'day'
    ];
    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_offer_types', 'offer_id', 'offer_product_id');
    }
    public function OfferType(){
        return $this->belongsTo(OfferType::class, 'offer_type_id');
    }
}
