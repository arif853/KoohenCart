<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($campaign) {
            $campaign->slug = Str::slug($campaign->camp_name);
        });

    }
    public function camp_product()
    {
        return $this->hasMany(Camp_product::class);
    }
}
