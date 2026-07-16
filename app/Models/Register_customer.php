<?php

namespace App\Models;

use App\Notifications\CustomerSetPasswordNotification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Register_customer extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use HasFactory;
    use Authenticatable;
    use CanResetPassword;
    use Notifiable;

    protected $fillable = ['customer_id', 'phone', 'email', 'password', 'password_set_at', 'status'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'password_set_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * True when this account is still on the random password generated for it at
     * checkout, i.e. the customer has never chosen one and cannot know it.
     */
    public function needsPassword(): bool
    {
        return $this->password_set_at === null;
    }

    /**
     * Point the reset link at the customer routes rather than the staff ones.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomerSetPasswordNotification($token, $this->needsPassword()));
    }
}
