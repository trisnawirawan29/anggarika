<?php

namespace App\Models;

use Database\Factories\InvitationGuestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InvitationGuest extends Model
{
    /** @use HasFactory<InvitationGuestFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = ['name', 'slug', 'phone', 'is_active'];

    protected static function booted(): void
    {
        static::creating(function (InvitationGuest $guest): void {
            if (filled($guest->slug)) {
                return;
            }

            $baseSlug = Str::slug($guest->name) ?: 'tamu';
            $slug = $baseSlug;
            $counter = 2;

            while (static::query()->where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$counter;
                $counter++;
            }

            $guest->slug = $slug;
        });
    }

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
