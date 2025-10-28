<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'quantity',
        'price',
        'total',
    ];

    public function getImageAttribute()
    {
        return $this->model?->image ?? asset('assets/images/image.png');
    }
}
