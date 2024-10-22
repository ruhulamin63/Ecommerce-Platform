<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        // category slug automatically generated
        static::saving(function ($category) {
            $category->slug = Str::slug($category->name);

        });
    }

    public function subcategories() {
        return $this->hasMany(Subcategory::class);
    }
}
