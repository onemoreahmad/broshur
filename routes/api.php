<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\TenantResource;
use App\Http\Resources\UserResource;
use App\Models\Block;

Route::get('/auth', function (Request $request) {
    $data = collect($request->user()->load('tenant')->only('id', 'name', 'email','tenant'));
    return response()->json([
        'tenant' => TenantResource::make($data->get('tenant')) ,
        'user' => UserResource::make($request->user()) ,
    ]);
})->middleware('auth:sanctum');


Route::post('/account', function (Request $request) {

    $request->user()->update($request->all());
    return response()->json([
        'message' => 'Account updated successfully',
        'user' => UserResource::make($request->user()) ,
    ]);
})->middleware('auth:sanctum');

Route::post('/tenant/theme', function (Request $request) {
    $request->validate([
        'theme_id' => 'required|integer|min:1'
    ]);

    $tenant = $request->user()->tenant;
    $tenant->theme_id = $request->theme_id;
    $tenant->save();

    return response()->json([
        'message' => 'Theme updated successfully',
        'tenant' => TenantResource::make($tenant),
    ]);
})->middleware('auth:sanctum');

Route::post('/tenant/handle', function (Request $request) {
    $request->validate([
        'handle' => [
            'required',
            'string',
            'min:3',
            'max:50',
            'regex:/^[a-z0-9-]+$/',
            'unique:tenants,handle,' . $request->user()->tenant->id
        ]
    ], [
        'handle.regex' => 'اسم المستخدم يجب أن يحتوي على أحرف صغيرة وأرقام وشرطات فقط',
        'handle.unique' => 'اسم المستخدم هذا مستخدم بالفعل',
        'handle.min' => 'اسم المستخدم يجب أن يكون على الأقل 3 أحرف',
        'handle.max' => 'اسم المستخدم يجب أن يكون أقل من 50 حرف'
    ]);

    $tenant = $request->user()->tenant;
    $tenant->handle = $request->handle;
    $tenant->save();

    return response()->json([
        'message' => 'Handle updated successfully',
        'tenant' => TenantResource::make($tenant),
    ]);
})->middleware('auth:sanctum');


// Manage Blocks
Route::middleware(['auth:sanctum','admin'])
    ->prefix('blocks')
    ->as('blocks.')
    ->namespace('App\Api\Block')
    ->group(function () {
       Route::get('header', Header\GetHeader::class);
       Route::post('header', Header\UpdateHeader::class);
    });

 