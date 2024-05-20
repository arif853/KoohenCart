<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebInfo extends Model
{
    use HasFactory;

    protected $fillable = ['appName','description','weblogo','webfavicon','marquee','copyright'];
}
