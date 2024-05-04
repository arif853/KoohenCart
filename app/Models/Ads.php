<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [ 'header','title','btntext','shop_url','is_featured','is_feature_no','image','status'];
}
