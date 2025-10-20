<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Tenant;

trait Tenantable
{
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public static function bootTenantable()
    {
        $tenant = currentTenant() ?? tenant();
        
        // save
        static::creating(function (self $model) use ($tenant) {
            if ($tenant && is_null($model->tenant_id)) {
                if (is_null($model->tenant_id)) {
                    $model->tenant_id = $tenant->id;
                }
            }
        });

        static::addGlobalScope('tenantable', function (Builder $builder) use ($tenant) {
            if ($tenant) {
                $builder->where('tenant_id', $tenant->id);
            }
        });
    }
}
