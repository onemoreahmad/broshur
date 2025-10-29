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
    ];

    protected $clone_exempt_attributes = ['slug'];

    protected $guarded = [];
}
