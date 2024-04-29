<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id','status',
        'confirmed_date_time',
        'shipped_date_time',
        'delivered_date_time',
        'completed_date_time',
        'returned_date_time',
        'cancelled_date_time'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
