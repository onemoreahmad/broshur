<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        Livewire::addPersistentMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
            \App\Http\Middleware\CurrentBroshur::class,
        ]);
    }
}
