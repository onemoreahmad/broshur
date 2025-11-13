<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
 
// admin 
Route::as('dashboard.')
->prefix('dashboard')
->middleware(['auth', 'admin'])
->group(function () {
    
    Route::post('upload-media', [\App\Actions\UploadMedia::class, 'upload'])->name('upload-media');
    Route::post('upload-image', [\App\Actions\UploadImage::class, 'upload'])->name('upload-image');

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
  