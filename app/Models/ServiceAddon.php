<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use YMigVal\LaravelModelCache\HasCachedQueries;

class ServiceAddon extends Model
{
    use HasFactory, HasCachedQueries;

    protected $cacheMinutes = 1200; // 20 hours

    protected $cachePrefix = 'service_addons_';
    
    protected $fillable = [
        'service_id',
        'name',
        'price',
        'active',
        'sort',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort' => 'integer',
        'price' => 'integer',
    ];

    /**
     * Get the service that owns the addon.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
