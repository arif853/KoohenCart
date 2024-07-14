<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['customer_id','subtotal','discount','tax','total','is_shipping_different','delivery_charge','comment','total_paid','total_due','is_pos'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order_item()
    {
        return $this->hasMany(order_items::class);
    }

    public function shipping()
    {
        return $this->hasOne(shipping::class);
    }

    public function transaction()
    {
        return $this->hasOne(transactions::class);
    }

    public function orderStatus()
    {
        return $this->hasOne(Orderstatus::class);
    }

    public function appliedCoupone()
    {
        return $this->belongsTo(AppliedCoupone::class, 'order_id');
    }

    public function steadfastorder()
    {
        return $this->hasOne(SteadfastOrder::class, 'order_id');
    }
}
