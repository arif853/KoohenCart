<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'primary_mobile_no',
        'secondary_mobile_no',
        'whatsapp_url',
        'email',
        'company_address',
        'company_short_details'
    ];
}
