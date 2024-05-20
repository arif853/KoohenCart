<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register_customer extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    protected $fillable = ['customer_id', 'phone', 'email', 'password'];

    // public function getAuthPassword()
    // {
    //     return $this->password;
    // }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
