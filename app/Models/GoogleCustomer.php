<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','token','refresh_token'];
}
