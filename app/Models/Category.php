<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Get badge styling class according to category theme.
     */
    public function getBadgeClassAttribute(): string
    {
        $normalized = strtolower($this->name . ' ' . $this->slug);

        if (str_contains($normalized, 'tekno') || str_contains($normalized, 'komp') || str_contains($normalized, 'infor')) {
            return 'bg-sky-50 text-sky-700 border-sky-200/90';
        }
        if (str_contains($normalized, 'bisnis') || str_contains($normalized, 'manajemen') || str_contains($normalized, 'ekonomi')) {
            return 'bg-amber-50 text-amber-800 border-amber-200/90';
        }
        if (str_contains($normalized, 'desain') || str_contains($normalized, 'seni') || str_contains($normalized, 'art')) {
            return 'bg-purple-50 text-purple-700 border-purple-200/90';
        }
        if (str_contains($normalized, 'sains') || str_contains($normalized, 'matematika') || str_contains($normalized, 'ipa')) {
            return 'bg-emerald-50 text-emerald-700 border-emerald-200/90';
        }
        if (str_contains($normalized, 'sastra') || str_contains($normalized, 'fiksi') || str_contains($normalized, 'novel')) {
            return 'bg-rose-50 text-rose-700 border-rose-200/90';
        }

        return 'bg-indigo-50 text-indigo-700 border-indigo-200/90';
    }

    /**
     * Get book spine preview gradient according to category theme.
     */
    public function getCoverGradientAttribute(): string
    {
        $normalized = strtolower($this->name . ' ' . $this->slug);

        if (str_contains($normalized, 'tekno') || str_contains($normalized, 'komp') || str_contains($normalized, 'infor')) {
            return 'from-sky-600 via-blue-700 to-indigo-950';
        }
        if (str_contains($normalized, 'bisnis') || str_contains($normalized, 'manajemen') || str_contains($normalized, 'ekonomi')) {
            return 'from-amber-500 via-orange-700 to-stone-900';
        }
        if (str_contains($normalized, 'desain') || str_contains($normalized, 'seni') || str_contains($normalized, 'art')) {
            return 'from-fuchsia-600 via-purple-700 to-slate-950';
        }
        if (str_contains($normalized, 'sains') || str_contains($normalized, 'matematika') || str_contains($normalized, 'ipa')) {
            return 'from-emerald-500 via-teal-700 to-slate-950';
        }
        if (str_contains($normalized, 'sastra') || str_contains($normalized, 'fiksi') || str_contains($normalized, 'novel')) {
            return 'from-rose-500 via-pink-700 to-stone-950';
        }

        return 'from-indigo-600 via-royal-700 to-slate-950';
    }

    /**
     * Get dot color indicator class.
     */
    public function getDotColorAttribute(): string
    {
        $normalized = strtolower($this->name . ' ' . $this->slug);

        if (str_contains($normalized, 'tekno') || str_contains($normalized, 'komp') || str_contains($normalized, 'infor')) {
            return 'bg-sky-500';
        }
        if (str_contains($normalized, 'bisnis') || str_contains($normalized, 'manajemen') || str_contains($normalized, 'ekonomi')) {
            return 'bg-amber-500';
        }
        if (str_contains($normalized, 'desain') || str_contains($normalized, 'seni') || str_contains($normalized, 'art')) {
            return 'bg-purple-500';
        }
        if (str_contains($normalized, 'sains') || str_contains($normalized, 'matematika') || str_contains($normalized, 'ipa')) {
            return 'bg-emerald-500';
        }
        if (str_contains($normalized, 'sastra') || str_contains($normalized, 'fiksi') || str_contains($normalized, 'novel')) {
            return 'bg-rose-500';
        }

        return 'bg-indigo-500';
    }
}
