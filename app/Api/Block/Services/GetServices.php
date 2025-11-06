<?php

namespace App\Api\Block\Services;

use App\Models\Block;
use App\Models\Service;
use Lorisleiva\Actions\Concerns\AsAction;

class GetServices
{
    use AsAction;

    public function handle()
    {
        $tenantId = currentTenant()->id;
        
        // Get services for current tenant
        $services = Service::where('tenant_id', $tenantId)
            ->with('addons')
            ->orderBy('sort')
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'subtitle' => $service->subtitle,
                    'detail' => $service->detail,
                    'price' => $service->price !== null ? $service->price / 100 : null, // Convert cents to normal price
                    'icon' => $service->icon,
                    'image' => $service->image,
                    'image_url' => $service->image_url,
                    'active' => $service->active,
                    'sort' => $service->sort,
                    'addons' => $service->addons->map(function ($addon) {
                        return [
                            'id' => $addon->id,
                            'name' => $addon->name,
                            'price' => $addon->price !== null ? $addon->price / 100 : null, // Convert cents to normal price
                            'active' => $addon->active,
                            'sort' => $addon->sort,
                        ];
                    }),
                ];
            });

        $block = Block::firstOrCreate([
            'name' => 'services',    
        ],['active' => false]);

        return response()->json([
            'data' => [
                'id' => $block->id,  
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'services' => $services,
            ],
        ]);
    }
}

