<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use YMigVal\LaravelModelCache\HasCachedQueries;

class PlaylistItem extends Model
{
    use HasFactory, HasCachedQueries;

    protected $cacheMinutes = 1200; // 20 hours

    protected $cachePrefix = 'playlist_items_';
    
    protected $fillable = [
        'playlist_id',
        'name',
        'cover',
        'path',
        'file',
        'link',
        'type',
        'meta',
        'sort',
    ];

    protected $casts = [
        'sort' => 'integer',
        'meta' => SchemalessAttributes::class,
    ];

    /**
     * Get the playlist that owns the item.
     */
    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class);
    }

    /**
     * Get the cover URL.
     */
    public function getCoverUrlAttribute(): string
    {
        if (!$this->cover) {
            return '';
        }

        // If it's already a full URL, return as is
        if (str_starts_with($this->cover, 'http')) {
            return $this->cover;
        }

        // Otherwise, construct the URL
        return "https://storage.broshur.com/{$this->cover}";
    }
}

