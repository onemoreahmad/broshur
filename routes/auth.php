<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;
  
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialAccount;
use App\Actions\CreateTenant;
use App\Models\Tenant;

// auth routes 
Route::as('auth.')
->middleware(['web'])
->group(function () {
    Volt::route('/register/verify/{token}', 'auth.register-verify')->middleware('guest')->name('register.verify');
    Volt::route('/reset-password/{token}', 'auth.password-reset')->middleware('guest')->name('password.reset')->middleware('guest');
    Volt::route('/password/forgot-password', 'auth.forgot-password')->middleware('guest')->name('password.forgot-password')->middleware('guest');
    Volt::route('/register-login', 'auth.register-login')->name('register-login')->middleware('guest');

    Route::get('/logout', function (Request $request) {
        auth()->logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        // app()->instance('tenant', null);
        config()->set('tenant', null);

        return redirect()->route('site.home');
    })->name('logout')->middleware('auth');
}); 
  

Route::get('/auth/{social}', function ($social) {
    if(!in_array($social, ['github', 'facebook', 'google'])) {
        return redirect()->route('site.home');
    }
    
    return Socialite::driver($social)->redirect();
})->name('auth.social');
 

Route::get('/auth/{social}/callback', function ($social) {

    if(!in_array($social, ['github', 'facebook', 'google'])) {
        return redirect()->route('auth.register-login');
    }

    $user = Socialite::driver($social)->user();
   
    $checkEmail = User::where('email', $user->getEmail())->first();

    if($checkEmail) {
        // create social account
        $socialAccount = SocialAccount::firstOrCreate([
            'user_id' => $checkEmail->id,
            'provider' => $social
        ],[
            'provider_id' => $user->getId(),
            'provider_token' => data_get($user, 'token'),
            'provider_refresh_token' => data_get($user, 'refreshToken'),
            'meta' => $user,
        ]);

        auth()->login($checkEmail);
       
        return redirect(route('dashboard.home').'/content');
    }

    $myUser = User::firstOrCreate(
        ['email' => $user->getEmail()], 
        [
            'name' => $user->getName(),
            'image' => $user->getAvatar(),
            'username' => $user->getNickname().'-'.rand(1000,9999),
        ]);
  
        // create social account
        $socialAccount = SocialAccount::firstOrCreate([
            'user_id' => $myUser->id,
            'provider' => $social], 
        [
            'provider_id' => $user->getId(),
            'provider_token' => data_get($user, 'token'),
            'provider_refresh_token' => data_get($user, 'refreshToken'),
            'meta' => $user,
        ]);


    // create tenant for the user if not exists    
    $tenant = Tenant::where('user_id', $myUser->id)->first();
    if(!$tenant) {
        $tenant = CreateTenant::run([
            'tenant_name' => $user->name,
            'tenant_handle' => generateKey(7),
            'email' => $user->getEmail(),
            'user_id' => $myUser->id,
        ]);
    }

    $myUser->update([
        'current_tenant_id' => $tenant->id,
    ]);
 
    auth()->login($myUser);

    return redirect(route('dashboard.home').'/content');
});