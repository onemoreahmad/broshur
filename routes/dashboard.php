<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
 
// admin 
Route::as('dashboard.')
->prefix('dashboard')
->middleware(['auth', 'admin'])
->group(function () {
    
         // payment callback route
         Route::as('payment.')
         ->prefix('payment')
         ->get('callback', \App\Actions\PaymentCallback::class)
             ->middleware('auth')
             ->name('callback');
             
    Route::get('/{pathMatch?}', function () {
        return view('dashboard');
    })->where('pathMatch', '.*')->name('home');
  
    
});
  