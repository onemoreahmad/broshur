<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\TenantResource;
use App\Http\Resources\UserResource;

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