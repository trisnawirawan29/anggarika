<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LandingGalleryItem extends Model
{
    protected $fillable = ['image_path', 'category', 'sort_order'];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return Attribute<string, never>
     */
    protected function categorySlug(): Attribute
    {
        return Attribute::get(fn (): string => 'category-'.Str::slug($this->category));
    }
}
