<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Illuminate\Support\Facades\Storage;
use LucasDotVin\Soulbscription\Models\Concerns\HasSubscriptions;

class Tenant extends Model
{
    use HasSubscriptions;
    
    public $casts = [
        'meta' => SchemalessAttributes::class,
        'default_currencies' => 'array',
        'linkinbio_theme_options' => 'array',
    ];

    protected $fillable = [
        'name',
        'handle',
        'user_id',
        'theme_id',
        'domain',
        'domain_status',
        'meta',
        'active',
        'traffic_website_id',
    ];

    public function getUrlAttribute()
    {
        $protocol =  'https://' ;

        return $this->domain && $this->domain_status == 1 ? $protocol . $this->domain : $protocol . $this->handle . '.' . config('app.domain');
    }

    public function getLogoAttribute($value)
    {
        if ($value) {
            return Storage::url($value);
        }
  
        $parms = http_build_query([
            'background' => '#219EBD',
            'rounded' => 'true',
            'color' => 'fff',
            'name' => data_get($this, 'handle'),
        ]);

        // return 'https://ui-avatars.com/api?'.$parms;

        return 'https://ui-avatars.com/api/?background=219EBD&color=fff&name=' . data_get($this, 'name');
    }

    public function getSiteUrlAttribute()
    {
        return 'https://' . $this->handle . '.' . config('app.domain');
    }

    public function getStorefrontUrlAttribute()
    {
        // return 'https://' . $this->handle . '.' . config('app.domain') . '/links';
        return route('storefront.home', $this->handle);
        // return $this->siteUrl . '/links';
        // return $this->siteUrl . '/link-in-bio';
    }
 
 
    public function getSloganAttribute()
    {
        return data_get($this, 'meta.slogan') ? data_get($this, 'meta.slogan.'.app()->getLocale()) : null;
    }

    public function getSocialLinksAttribute()
    {
        return data_get($this, 'meta.socialLinks', []);
    }
    
}
