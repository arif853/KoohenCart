<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySizeHeader extends Model
{
    use HasFactory;

    protected $table = 'category_size_headers';

    protected $fillable = ['category_id', 'size_id', 'size_header_id', 'value'];

    public function category(){

        return $this->belongsTo(Category::class, 'category_id');
        
    }

    public function size(){

        return $this->belongsTo(Size::class, 'size_id');

    }

    public function sizeHeader(){

        return $this->belongsTo(sizeHeader::class, 'size_header_id');

    }
}
