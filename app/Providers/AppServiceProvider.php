<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use MeShaon\RequestAnalytics\Models\RequestAnalytics;
use App\Observers\RequestAnalyticsObserver;
 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadViewsFrom( resource_path('views/admin'), 'admin'); 
        $this->loadViewsFrom( resource_path('views/site'), 'site'); 
        $this->loadViewsFrom( resource_path('views/auth'), 'auth'); 
        $this->loadViewsFrom( resource_path('views/storefront'), 'storefront'); 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \URL::forceScheme('https');

        Livewire::addPersistentMiddleware([
            \App\Http\Middleware\CurrentBroshur::class,
        ]);
  
        RequestAnalytics::observe(RequestAnalyticsObserver::class);
    }
}
