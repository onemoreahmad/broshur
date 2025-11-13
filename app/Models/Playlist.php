<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Tenantable;
use YMigVal\LaravelModelCache\HasCachedQueries;

class Playlist extends Model
{
    use HasFactory, Tenantable, HasCachedQueries;

    protected $cacheMinutes = 1200; // 20 hours

    protected $cachePrefix = 'playlists_';
    
    protected $fillable = [
        'tenant_id',
        'block_id',
        'name',
        'slug',
        'logo',
        'cover',
        'description',
        'active',
        'sort',
        'meta',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort' => 'integer',
        'meta' => 'array',
    ];

    /**
     * Get the tenant that owns the playlist.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the block that owns the playlist.
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Get the items for the playlist.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PlaylistItem::class)->orderBy('sort');
    }

    /**
     * Get the logo URL.
     */
    public function getLogoUrlAttribute(): string
    {
        if (!$this->logo) {
            return '';
        }

        // If it's already a full URL, return as is
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }

        // Otherwise, construct the URL
        return "https://storage.broshur.com/{$this->logo}";
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

