<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        // subcategory slug automatically generated
        static::saving(function ($subcategory) {
            $subcategory->slug = Str::slug($subcategory->name);
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
