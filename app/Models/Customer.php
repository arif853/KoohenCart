<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['firstName','lastName','phone','email','billing_address','division','district','area','status'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function register_customer()
    {
        return $this->hasOne(Register_customer::class);
    }

    public function shipping()
    {
        return $this->hasMany(shipping::class);
    }

    public function transaction()
    {
        return $this->hasMany(transactions::class);
    }
    
    public function appliedCoupone()
    {
        return $this->belongsTo(AppliedCoupone::class, 'customer_id');
    }
}
