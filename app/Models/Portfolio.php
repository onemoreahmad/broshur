<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'tenant_id',
        'block_id',
        'name',
        'image',
        'caption',
        'active',
        'sort',
        'meta',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort' => 'integer',
        'meta' => 'array',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return '';
        }

        // If it's already a full URL, return as is
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Otherwise, construct the URL
        return "https://storage.broshur.com/{$this->image}";
    }
}
