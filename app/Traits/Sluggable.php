<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Sluggable
{
    public static function booted(): void
    {
        parent::booted();

        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = slug($model->{$model->sluggableField ?? 'name'});
            }
        });
    }
}
