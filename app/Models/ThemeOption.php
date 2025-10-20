<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;

class ThemeOption extends Model
{
    use Tenantable;
    
    protected $guarded = [];

    public $casts = [
        'config' => 'array',
        // 'config' => SchemalessAttributes::class,
        'active' => 'boolean',
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);  
    }
}
