<?php

use Illuminate\Support\Facades\Route;

Route::get('/auth', \App\Api\Auth\GetAuth::class)->middleware('auth:sanctum');


Route::post('/account', \App\Api\Account\UpdateAccount::class)->middleware('auth:sanctum');

Route::post('/tenant/theme', \App\Api\Tenant\UpdateTheme::class)->middleware('auth:sanctum', 'admin');

Route::post('/tenant/handle', \App\Api\Tenant\UpdateHandle::class)->middleware('auth:sanctum', 'admin');

Route::get('/countries', \App\Api\Countries\GetCountries::class)->middleware('auth:sanctum');

Route::post('/tenant/location', \App\Api\Tenant\UpdateLocation::class)->middleware('auth:sanctum', 'admin');

Route::post('/tenant/contact', \App\Api\Tenant\UpdateContact::class)->middleware('auth:sanctum', 'admin');

// Themes
Route::get('/themes', \App\Api\Theme\GetThemes::class)->middleware('auth:sanctum', 'admin');

// Save theme options
Route::post('/theme-options', \App\Api\Theme\UpdateThemeOptions::class)->middleware('auth:sanctum', 'admin');

Route::get('/orders', \App\Api\Order\GetOrders::class)->middleware('auth:sanctum','admin');

Route::post('/orders', \App\Api\Order\CreateOrder::class)->middleware('auth:sanctum','admin');

Route::get('/orders/{id}', \App\Api\Order\GetOrder::class)->middleware('auth:sanctum','admin');

Route::get('/subscribers', \App\Api\Subscriber\GetSubscribers::class)->middleware('auth:sanctum','admin');

Route::post('/subscribers', \App\Api\Subscriber\CreateSubscriber::class)->middleware('auth:sanctum','admin');

Route::delete('/subscribers/{id}', \App\Api\Subscriber\DeleteSubscriber::class)->middleware('auth:sanctum','admin');

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('dashboard')
    ->as('dashboard.')
    ->group(function () {
        Route::get('summary', \App\Api\Dashboard\GetSummary::class);
        Route::get('analytics/overview', [\App\Api\Dashboard\GetAnalytics::class, 'overview']);
    });

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('subscription')
    ->as('subscription.')
    ->group(function () {
        Route::get('plans', \App\Api\Subscription\GetPlans::class);
        Route::post('/', \App\Api\Subscription\SubscribeToPlan::class);
    });


// Manage Blocks
Route::middleware(['auth:sanctum','admin'])
    ->prefix('blocks')
    ->as('blocks.')
    ->namespace('App\Api\Block') 
    ->group(function () {
        Route::get('header', Header\GetHeader::class);
        Route::post('header', Header\UpdateHeader::class);
        Route::get('about', About\GetAbout::class);
        Route::post('about', About\UpdateAbout::class);
        Route::get('links', Links\GetLinks::class);
        Route::post('links', Links\UpdateLinks::class);
        Route::get('cta', Cta\GetCta::class);
        Route::post('cta', Cta\UpdateCta::class);
        Route::get('faq', Faq\GetFaq::class);
        Route::post('faq', Faq\UpdateFaq::class);
        Route::get('features', Features\GetFeatures::class);
        Route::post('features', Features\UpdateFeatures::class);
        Route::get('portfolio', Portfolio\GetPortfolio::class);
        Route::post('portfolio', Portfolio\UpdatePortfolio::class);
        Route::get('reviews', Reviews\GetReviews::class);
        Route::post('reviews', Reviews\UpdateReviews::class);
        Route::get('team', Team\GetTeam::class);
        Route::post('team', Team\UpdateTeam::class);
        Route::get('services', Services\GetServices::class);
        Route::post('services', Services\UpdateServices::class);
        Route::get('agreement', Agreement\GetAgreement::class);
        Route::post('agreement', Agreement\UpdateAgreement::class);
    });

// Contact form endpoint (public)
Route::post('/contact', \App\Api\Contact\SubmitContact::class);

 