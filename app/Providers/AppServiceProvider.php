<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
 
 
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
  
    }
}
