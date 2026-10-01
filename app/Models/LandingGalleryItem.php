<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingGalleryItem extends Model
{
    protected $fillable = ['image_path', 'category', 'sort_order'];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }
}
