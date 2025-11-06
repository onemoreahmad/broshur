<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;

class TeamMember extends Model
{
    use HasFactory, Tenantable;

    protected $fillable = [
        'tenant_id',
        'block_id',
        'name',
        'job_title',
        'bio',
        'image',
        'active',
        'sort',
        'meta',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort' => 'integer',
        'meta' => SchemalessAttributes::class,
    ];

    /**
     * Get the tenant that owns the team member.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the block that owns the team member.
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Get the image URL.
     */
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
