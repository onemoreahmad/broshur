<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
  
// sitefront routes
Volt::route('{tenant}/{lang?}', 'storefront.home')
    // ->domain('{tenant}.' . config('app.domain'))
    ->middleware(['currentBroshur'])
    ->name('storefront.home');

Volt::route('{tenant}/agreement', 'storefront.agreement')
    ->middleware(['currentBroshur'])
    ->name('storefront.agreement');

Volt::route('{tenant}/preview', 'storefront.home')
    // ->domain('{tenant}.' . config('app.domain'))
    ->middleware(['currentBroshur'])
    ->name('storefront.home.preview');
 