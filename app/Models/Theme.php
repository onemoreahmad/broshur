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

    protected $appends = ['optionFields'];
 
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
        if (file_exists(public_path('themes/' . $this->slug . '/image.webp'))) {
            return asset('themes/' . $this->slug . '/image.webp');
        }

        return asset('assets/images/theme-image.webp');
    }

    public function getOptionFieldsAttribute() 
    {
        $path = public_path('themes/' . $this->slug . '/options.json');
 
        if (\File::exists($path)) {
 
            $jsonFile = json_decode(file_get_contents($path), true);
            $optionFields = $jsonFile ?: [];

            return $optionFields;
        }

        return [];
    }

    public function getTenantOptionsAttribute()
    {
        return $this->options->first()?->config ?? null;
    }
}
