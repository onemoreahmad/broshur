<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;
use Bkwld\Cloner\Cloneable;
use YMigVal\LaravelModelCache\HasCachedQueries;
use Kra8\Snowflake\HasShortflakePrimary;

class Link extends Model
{
    use Tenantable, Cloneable, HasCachedQueries, HasShortflakePrimary;

    protected $cacheMinutes = 1200; // 20 hours

    protected $cachePrefix = 'links_';
    
 
    public $casts = [
        'meta' => SchemalessAttributes::class,
        'active' => 'boolean',
    ];

    protected $fillable = [
        'tenant_id',
        'block_id',
        'type',
        'link',
        'meta',
        'active',
        'name',
        'slug',
        'sort',
    ];
    protected $clone_exempt_attributes = ['slug'];

    protected $guarded = [];
}
