<?php

namespace App\Models;

use LucasDotVin\Soulbscription\Models\Subscription as SSubscription;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;

class Subscription extends SSubscription
{
    use Tenantable;

    protected $fillable = [
        'tenant_id',
        'is_system',
        'canceled_at',
        'expired_at',
        'grace_days_ended_at',
        'started_at',
        'suppressed_at',
        'was_switched',
    ];
}
