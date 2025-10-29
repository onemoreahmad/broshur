<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;

class Review extends Model
{
    use HasFactory, Tenantable;

    protected $fillable = [
        'tenant_id',
        'block_id',
        'client_name',
        'client_email',
        'client_phone',
        'score',
        'review_text',
        'active',
        'sort',
        'meta',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort' => 'integer',
        'score' => 'integer',
        'meta' => SchemalessAttributes::class,
    ];

    /**
     * Get the tenant that owns the review.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the block that owns the review.
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Get the formatted score as stars.
     */
    public function getStarsAttribute(): string
    {
        return str_repeat('★', $this->score) . str_repeat('☆', 5 - $this->score);
    }

    /**
     * Get the score percentage.
     */
    public function getScorePercentageAttribute(): int
    {
        return ($this->score / 5) * 100;
    }
}