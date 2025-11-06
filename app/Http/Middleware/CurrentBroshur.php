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
        $tenant = $this->resolveTenant($request);

        if (!$tenant) {
            if ($request->expectsJson() || $request->wantsJson() || $this->isLivewireRequest($request)) {
                return response()->json(['message' => 'Tenant not found'], 404);
            }

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

    protected function resolveTenant(Request $request): ?Tenant
    {
        if ($existing = config('tenant')) {
            return $existing;
        }

        if ($tenantId = session('current_tenant_id')) {
            if ($tenant = Tenant::find($tenantId)) {
                return $tenant;
            }
        }

        if ($routeTenant = $request->route('tenant')) {
            if ($tenant = Tenant::where('handle', $routeTenant)->first()) {
                return $tenant;
            }
        }

        if ($handle = $request->query('tenant')) {
            if ($tenant = Tenant::where('handle', $handle)->first()) {
                return $tenant;
            }
        }

        if ($this->isLivewireRequest($request)) {
            if ($tenant = $this->resolveTenantFromLivewirePayload($request)) {
                return $tenant;
            }
        }

        if ($tenant = $this->resolveTenantFromHost($request)) {
            return $tenant;
        }

        if (auth()->check()) {
            return auth()->user()->tenant;
        }

        return null;
    }

    protected function resolveTenantFromHost(Request $request): ?Tenant
    {
        $host = $request->getHost();

        $domainTenant = Tenant::where('domain', $host)
            ->where('domain_status', 1)
            ->first();

        if ($domainTenant) {
            return $domainTenant;
        }

        $parts = explode('.', $host);

        if (count($parts) >= 3) {
            $subdomain = Arr::first($parts);
            if ($tenant = Tenant::where('handle', $subdomain)->first()) {
                return $tenant;
            }
        }

        if ($host === config('app.domain')) {
            if ($tenantHandle = session('current_tenant_handle')) {
                if ($tenant = Tenant::where('handle', $tenantHandle)->first()) {
                    return $tenant;
                }
            }
        }

        return null;
    }

    protected function resolveTenantFromLivewirePayload(Request $request): ?Tenant
    {
        $payload = json_decode($request->getContent(), true);

        if (!is_array($payload)) {
            return null;
        }

        $path = data_get($payload, 'fingerprint.path');

        if (!$path) {
            return null;
        }

        $segments = array_values(array_filter(explode('/', trim($path, '/'))));

        if (empty($segments)) {
            return null;
        }

        $firstSegment = $segments[0];

        if ($firstSegment === 'admin' && auth()->check()) {
            return auth()->user()->tenant;
        }

        if (Str::lower($firstSegment) === 'preview' && count($segments) > 1) {
            $firstSegment = $segments[1];
        }

        return Tenant::where('handle', $firstSegment)->first();
    }

    protected function isLivewireRequest(Request $request): bool
    {
        return $request->hasHeader('X-Livewire');
    }
}
