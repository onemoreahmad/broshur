<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class OrderItem extends Model
{
    public $casts = [
        'data' => SchemalessAttributes::class,
    ];

    protected $fillable = [
        'order_id',
        'name',
        'quantity',
        'price',
        'total',
        'data',
    ];

    public function getImageAttribute()
    {
        return $this->model?->image ?? asset('assets/images/image.png');
    }
}
