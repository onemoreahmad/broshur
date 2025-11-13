<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;

class Client extends Model
{
    use Tenantable, SoftDeletes;

    public $casts = [
        'meta' => SchemalessAttributes::class,
    ];

    protected $fillable = [
        'tenant_id',
        'name',
        'phone',
        'email',
        'meta',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
