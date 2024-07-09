<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SteadfastOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','consignment_id','invoice','tracking_code'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
