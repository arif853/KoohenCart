<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'order_id', 'first_name', 'last_name', 's_phone','s_email', 'shipping_add','division','district','area'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function zone()
    {
        return $this->belongsTo(Postcode::class, 'area' );
    }
}
