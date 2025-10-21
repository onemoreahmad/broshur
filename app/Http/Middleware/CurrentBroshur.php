<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;
use App\Models\Theme;
// use App\Models\Setting;

class CurrentBroshur
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = request()->getHost();
        $domain = data_get(explode('.', $host), '1') . '.' . data_get(explode('.', $host), '2');
        $subdomain = $domain == config('app.domain') ? data_get(explode('.', $host), '0') : $host;
    
        // conflict with preview route within same domain
        // if ($subdomain == config('app.domain')) {
        //     return $next($request);
        // }   
   
        $tenant = Tenant::where('handle', $subdomain)->orWhere('handle', data_get(request(), 'tenant'))->orWhere(function ($q) use ($host) {
            $q->where('domain', $host)->where('domain_status', 1);
        })->first();

        if(!$tenant){
            return response()->view('errors.tenant-not-found');
        }
 
        config()->set('tenant', $tenant);
 
        // $settings = Setting::where('tenant_id', $tenant->id)->where('name', 'settings')->first();
        $theme = Theme::where('id', $tenant->theme_id)->first();
    
        // config()->set('settings', data_get($settings, 'config', []));
   
  
        view()->addNamespace(
            'theme',
            public_path('themes/' .  data_get($theme, 'slug', 'default'))
        );
 
        return $next($request);
    }
}
