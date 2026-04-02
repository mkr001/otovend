<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['slug', 'name_pl', 'name_en', 'icon'];

    /**
     * Get the localized name based on the current app locale.
     */
    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? $this->name_en : $this->name_pl;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'slug');
    }
}
