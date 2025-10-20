<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function getImageAttribute()
    {
        return $this->model?->image ?? asset('assets/images/image.png');
    }
}
