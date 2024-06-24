<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialinfo extends Model
{
    use HasFactory;

    protected $fillable = ['social_title','title_value','status'];
}
