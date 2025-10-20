<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use App\Models\Tenant;
// use App\Models\Plan;

class CreateTenant
{
    use AsAction, WithAttributes;

    public function rules(): array
    {
        return [
            'tenant_name' => 'required|min:2|max:200',
            'tenant_handle' => 'required|min:2|max:100|alpha_dash:ascii,unique:tenants,handle',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function handle(array $data): Tenant
    {
        $this->fill($data);
        
        $validatedData = $this->validateAttributes();
        
        $websiteId = $this->createTrafficWebsite($validatedData);

        $tenant = Tenant::create([
            'name' => $validatedData['tenant_name'],
            'handle' => $validatedData['tenant_handle'],
            'user_id' => $validatedData['user_id'],
            'theme_id' => 1,
            'traffic_website_id' => $websiteId,
            // 'meta' => [
            //     'traffic_website_id' => $websiteId,
            // ],
        ]);

        // $plan = Plan::where('slug', 'basic')
        //     ->where('is_system', true)
        //     ->where('active', true)
        //     ->first();

        // if ($plan) {    
        //     $tenant->subscribeTo($plan);
        // }

        return $tenant;
    }

    public function createTrafficWebsite($validatedData)
    {
        $response = \Http::withHeaders([
            'Authorization' => 'Bearer ' . env('TRAFFIC_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post(env('TRAFFIC_URL', 'https://traffic.wjeez.com') . '/api/v1/websites', [
            'domain' => $validatedData['tenant_handle'] .'.'. config('app.domain'), 
            // 'domain' => config('app.domain') . '/' . $validatedData['tenant_handle'], 
        ]);
 
        return $response->json('data.id');
    }

}
