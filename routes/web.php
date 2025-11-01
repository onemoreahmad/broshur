<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
 
// site routes
Route::as('site.')
->domain(config('app.domain'))
->middleware(['web'])
->group(function () {
    Volt::route('/', 'site.landing')->name('home');
    Volt::route('/ui', 'site.ui')->name('ui');
    Volt::route('about', 'site.page.about')->name('page.about');
    Volt::route('contact', 'site.page.contact')->name('page.contact');
    Volt::route('faq', 'site.page.faq')->name('page.faq');
    Volt::route('terms', 'site.page.terms')->name('page.terms');
    Volt::route('privacy', 'site.page.privacy')->name('page.privacy');
    Volt::route('plans', 'site.page.plans')->name('page.plans');

}); 

 