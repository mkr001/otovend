<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['vendor_id', 'name', 'price', 'description', 'category', 'location', 'condition', 'year', 'image'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
