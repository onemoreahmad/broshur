<?php

namespace App\Models;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use Tenantable, SoftDeletes;

    protected $fillable = [
      
        'name',
        'email',
        'meta',
    ];
}

