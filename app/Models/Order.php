<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;
use Kra8\Snowflake\HasShortflakePrimary;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;

class Order extends Model
{
    use HasStatuses , HasShortflakePrimary, Tenantable;

    public $casts = [
        'meta' => SchemalessAttributes::class,
    ];

    protected $fillable = [
        'tenant_id',
        'user_id',
        'client_id',
        'number',
        'status',
        'total',
        'notes',
        'meta',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = auth()->check() ? auth()->id() : null;
            $model->number =  self::where('tenant_id', $model->tenant_id)->count()  + 1000;
        });
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getSNumberAttribute()
    {
        return 'R-' . $this->number + 1000;
    }

    public function getHashedNumberAttribute()
    {
        return \Hashids::connection('orders')->encode($this->id);
    }
 
    public function getTitleNumberAttribute($value)
    {
        return __($value) . ' #' . $this->sNumber ?: $this->id;
    }
 
    public function getStatusAttribute()
    {
        return $this->status() ?: 'pending';
    }
 

    public function getDraftStatusAttribute()
    {
        return $this->is_draft ?  [
            'label' => 'Draft',
            'color' => 'orange',
        ]  : null;
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'orange',
            'paid' => 'green',
            'failed' => 'red',
            'refunded' => 'red',
            'canceled' => 'red',
            'expired' => 'red',
            'processing' => 'blue',
            'completed' => 'green',
            'progress' => 'yellow',
            'waiting' => 'purple',
            'awaiting_payment' => 'pink',
            'awaiting_fulfillment' => 'orange',
            'awaiting_shipment' => 'orange',
            'shipped' => 'green',
            'partially_shipped' => 'yellow',
            'awaiting_pickup' => 'purple',
            'cancelled' => 'red',
        

            default => 'gray',
        };
    }
}
