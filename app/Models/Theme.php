<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Theme extends Model
{
    protected $guarded = [];

    public $casts = [
        'meta' => SchemalessAttributes::class,
        'active' => 'boolean',
    ];
 
    public function options()
    {
        return $this->hasMany(ThemeOption::class);
    }
 
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute()
    {
        if (file_exists(public_path('themes/' . $this->slug . '/image.png'))) {
            return asset('themes/' . $this->slug . '/image.png');
        }

        return asset('assets/images/theme-image.webp');
    }
}
