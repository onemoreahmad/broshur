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

    $tenant = currentTenant();
    $tenant->theme_id = $request->theme_id;
    $tenant->save();

    return response()->json([
        'message' => 'Theme updated successfully'
    ]);
})->middleware('auth:sanctum','admin');

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
})->middleware('auth:sanctum', 'admin');

// Themes
Route::get('/themes', function () {
    $themes = \App\Models\Theme::where('active', true)
        ->orderBy('id', 'asc')
        ->get()
        ->map(function ($theme) {
            return [
                'id' => $theme->id,
                'name' => $theme->name,
                'slug' => $theme->slug ?? null,
                'image' => $theme->image, // accessor on model
                'price' => data_get($theme, 'price', null),
                'description' => data_get($theme, 'meta.description', null),
                'category' => data_get($theme, 'meta.category', null),
                'features' => (array) data_get($theme, 'meta.features', []),
                'optionFields' => $theme->optionFields  , // Get options from options.json file
                'tenantOptions' => $theme->tenantOptions,
            ];
        });

    return response()->json([
        'data' => $themes,
    ]);
})->middleware('auth:sanctum', 'admin');

// Save theme options
Route::post('/theme-options', function (Request $request) {
    $request->validate([
        'theme_id' => 'required|exists:themes,id',
        'options' => 'required|array',
    ]);

    // Get or create theme option record
    $themeOption = \App\Models\ThemeOption::firstOrCreate([
        'model_id' => $request->user()->tenant->id,
        'model_type' => \App\Models\Tenant::class,
        'theme_id' => $request->theme_id,
    ]);

    // Update the config with new options
    $themeOption->update([
        'config' => $request->options
    ]);

    return response()->json([
        'message' => 'Theme options updated successfully',
        'options' => $themeOption->config,
    ]);
})->middleware('auth:sanctum', 'admin');

Route::get('/orders', function (Request $request) {
    $orders = \App\Models\Order::where('tenant_id', $request->user()->tenant->id)
        ->with(['items' ])
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    return response()->json([
        'data' => $orders->items(),
        'pagination' => [
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'per_page' => $orders->perPage(),
            'total' => $orders->total(),
            'has_more' => $orders->hasMorePages()
        ]
    ]);
})->middleware('auth:sanctum');

Route::post('/orders', function (Request $request) {
    $request->validate([
        'client_name' => 'required|string|max:255',
        'client_phone' => 'nullable|string|max:20',
        'client_email' => 'nullable|email|max:255',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string|max:255',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.price' => 'required|numeric|min:0',
        'total' => 'required|numeric|min:0',
        'status' => 'required|string|in:pending,processing,completed,cancelled',
        'notes' => 'nullable|string|max:1000'
    ]);

    $tenant = $request->user()->tenant;
    
    // Create the order
    $order = \App\Models\Order::create([
        'tenant_id' => $tenant->id,
        'user_id' => $request->user()->id,
        'total' => $request->total,
        'meta' => [
            'notes' => $request->notes,
            'status' => $request->status,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'client_email' => $request->client_email,
        ]
    ]);

    // Create order items
    foreach ($request->items as $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'quantity' => $item['quantity'],
            'amount' => $item['price'],
            'total_pre_tax' => $item['quantity'] * $item['price'],
            'data' => [
                'name' => $item['name'],
                'notes' => $request->notes,
                'status' => $request->status,
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'client_email' => $request->client_email,
            ]
        ]);
    }

    // Set order status
    $order->setStatus($request->status);

    return response()->json([
        'message' => 'Order created successfully',
        'order' => $order->load(['items'])
    ]);
})->middleware('auth:sanctum');

Route::get('/orders/{id}', function (Request $request, $id) {
    $order = \App\Models\Order::where('tenant_id', $request->user()->tenant->id)
        ->with(['items'])
        ->findOrFail($id);

    return response()->json([
        'data' => $order,
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
              Route::get('agreement', Agreement\GetAgreement::class);
              Route::post('agreement', Agreement\UpdateAgreement::class);
    });

 