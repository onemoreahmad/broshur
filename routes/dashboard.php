<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
 
// admin 
Route::as('dashboard.')
->prefix('dashboard')
->middleware(['auth'])
->group(function () {
    
    Route::get('/{pathMatch?}', function () {
        return view('dashboard');
    })->where('pathMatch', '.*');
  
});
  