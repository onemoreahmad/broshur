<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Models\Theme;
use App\Models\ThemeOption;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CurrentBroshur
{
    public function handle(Request $request, Closure $next): Response
    {
       
        $tenant = Tenant::where('handle', $request->route('tenant'))->first();

        if(!$tenant){
            // return redirect()->to(config('app.url'));
            return response()->view('errors.tenant-not-found', status: 404);
        }

        config()->set('tenant', $tenant);
        session()->put('current_tenant_id', $tenant->id);
        session()->put('current_tenant_handle', $tenant->handle);

        $lang = data_get($request, 'lang', app()->getLocale());
        if (!in_array($lang, config('app.locales'))) {
            $lang = app()->getLocale();
        }
        app()->setLocale($lang);

        $theme = Theme::where('id', $tenant->theme_id)->first();
        $themeOptions = ThemeOption::where('theme_id', $tenant->theme_id)->first();

        config()->set('themeOptions', data_get($themeOptions, 'config', []));

        view()->addNamespace(
            'theme',
            public_path('themes/' . data_get($theme, 'slug', 'default'))
        );

        return $next($request);
    }
 
}
