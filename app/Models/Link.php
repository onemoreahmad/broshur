<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;
use Bkwld\Cloner\Cloneable;

class Link extends Model
{
    use Tenantable, Cloneable;
 
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
        'sort',
    ];
    protected $clone_exempt_attributes = ['slug'];

    protected $guarded = [];
}
