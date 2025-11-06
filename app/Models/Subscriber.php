<?php

namespace App\Models;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use Tenantable;

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'meta',
    ];
}

