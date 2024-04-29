<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp_product extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'campaign_id', 'regular_price' , 'camp_price','camp_qty','start_date','end_date'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
