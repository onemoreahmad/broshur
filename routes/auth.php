<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;
  
// auth routes 
Route::as('auth.')
->middleware(['web'])
->group(function () {
    Volt::route('/login', 'auth.login')->name('login')->middleware('guest');
    Volt::route('/register', 'auth.register')->name('register')->middleware('guest');
    Volt::route('/reset-password/{token}', 'auth.password-reset')->middleware('guest')->name('password.reset')->middleware('guest');
    Volt::route('/password/forgot-password', 'auth.forgot-password')->middleware('guest')->name('password.forgot-password')->middleware('guest');

    Route::get('/logout', function (Request $request) {
        auth()->logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        // app()->instance('tenant', null);
        config()->set('tenant', null);

        return redirect()->route('site.home');
    })->name('logout')->middleware('auth');
}); 
  