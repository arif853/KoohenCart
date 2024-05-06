<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactinfo extends Model
{
    use HasFactory;

    protected $fillable = ['phone','whatsapp','email','address','officehour'];
}
