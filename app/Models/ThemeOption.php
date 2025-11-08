<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use App\Traits\Tenantable;
use YMigVal\LaravelModelCache\HasCachedQueries;

class ThemeOption extends Model
{
    use Tenantable, HasCachedQueries;

    protected $cacheMinutes = 1200; // 20 hours

    protected $cachePrefix = 'theme_options_';
    
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
