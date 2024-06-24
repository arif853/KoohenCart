<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeHeader extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_size_headers')
                    ->withPivot('size_id', 'value')
                    ->withTimestamps();
    }
}
