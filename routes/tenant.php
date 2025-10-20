<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
  
// sitefront routes
Volt::route('{tenant}', 'storefront.home')
    // ->domain('{tenant}.' . config('app.domain'))
    ->middleware(['currentBroshur'])
    ->name('storefront.home');

Volt::route('{tenant}/preview', 'storefront.home')
    // ->domain('{tenant}.' . config('app.domain'))
    ->middleware(['currentBroshur'])
    ->name('storefront.home.preview');
 