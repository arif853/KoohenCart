<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['customer_id','subtotal','discount','tax','total','is_shipping_different','delivery_charge','delivery_zone','comment','total_paid','total_due','is_pos'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Human-readable delivery zone (e.g. "Inside Dhaka"). Orders placed before the
     * simplified checkout have no zone, hence the fallback.
     */
    public function deliveryZoneLabel(): string
    {
        return config('delivery.zones.' . $this->delivery_zone . '.label', 'N/A');
    }

    /**
     * Where THIS order goes, taken from its own shipping row.
     *
     * The customer profile is not the answer: a repeat guest's order deliberately
     * leaves the saved profile untouched, so reading it would ship the parcel to
     * whatever address that customer used last. The profile is only a fallback for
     * legacy orders that have no shipping row.
     */
    public function deliveryDetails(): object
    {
        $s = $this->shipping;

        return (object) [
            'name' => $s
                ? trim($s->first_name . ' ' . $s->last_name)
                : trim($this->customer->firstName . ' ' . $this->customer->lastName),
            'phone' => $s->s_phone ?? $this->customer->phone,
            'email' => $s->s_email ?? $this->customer->email,
            'address' => $s->shipping_add ?? $this->customer->billing_address,
        ];
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
