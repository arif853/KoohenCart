<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;
use App\Notifications\NewPendingOrderNotification ;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'is_shipping_different',
        'shipping_cost',
        'comment',
        'status',
        'total_paid',
        'total_due',
        'is_pos'];

        // protected static function booted()
        // {
        //     static::created(function ($order) {
        //         if ($order->status === 'pending') {
        //             // Trigger the notification when a new pending order is created
        //             $order->notify(new NewPendingOrderNotification($order));
        //         }
        //     });
        // }

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
}
