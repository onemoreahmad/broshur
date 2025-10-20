<?php

namespace App\Models;

use LucasDotVin\Soulbscription\Models\Plan as SPlan;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Plan extends SPlan
{
    protected $fillable = [
        'tenant_id',
        'is_system',
        'grace_days',
        'name',
        'price',
        'periodicity_type',
        'periodicity',
        'active',
    ];

    public $casts = [
        'meta' => 'json',
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcmul($value, 100),
            get: fn ($value) => $value / 100,
        );
    }

    public static function booted()
    {
        // static::updated(function () {
        //     cache()->forget('plans.getAll');
        // });

        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = slug($model->{$model->sluggableField ?? 'name'});
            }
        });
    }

    public static function getAll($periodicity = 'Year')
    {
        // return cache()->rememberForever('plans.getAll', function () {
        return Plan::where('is_system', true)
            // ->where('periodicity_type', $periodicity)
            // ->where('active', true)->get()->keyBy('label')->flatten();
            ->where('active', true)->get();
        // });
    }

    function getInfoAttribute()
    {
        return data_get($this->meta, 'info.0');
    }

    function getImageAttribute()
    {
        return asset('assets/images/plans/' . $this->slug . '.svg');
    }
}
