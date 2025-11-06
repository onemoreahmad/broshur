<?php

namespace App\Api\Block\Services;

use App\Models\Block;
use App\Models\Service;
use App\Models\ServiceAddon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateServices
{
    use AsAction;

    public function rules(): array
    {
        return [
            'services' => ['nullable', 'array'],
            'services.*.id' => ['nullable', 'integer', 'exists:services,id'],
            'services.*.name' => ['required', 'string', 'max:255'],
            'services.*.subtitle' => ['nullable', 'string', 'max:255'],
            'services.*.detail' => ['nullable', 'string', 'max:2000'],
            'services.*.price' => ['nullable', 'numeric', 'min:0'],
            'services.*.icon' => ['nullable', 'string', 'max:100'],
            'services.*.image' => ['nullable', 'string', 'max:1024'],
            'services.*.active' => ['nullable', 'boolean'],
            'services.*.addons' => ['nullable', 'array'],
            'services.*.addons.*.id' => ['nullable', 'integer', 'exists:service_addons,id'],
            'services.*.addons.*.name' => ['required', 'string', 'max:255'],
            'services.*.addons.*.price' => ['nullable', 'numeric', 'min:0'],
            'services.*.addons.*.active' => ['nullable', 'boolean'],
            'active' => ['nullable', 'boolean'],
            'title' => ['nullable', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:500'],
        ];
    }

    private function convertPriceToCents($price)
    {
        if ($price === null || $price === '') {
            return null;
        }
        return (int) round((float) $price * 100);
    }

    private function normalizeIcon($icon)
    {
        if ($icon === null || $icon === '') {
            return null;
        }
        return trim($icon);
    }

    public function handle(Request $request)
    {
        $tenantId = currentTenant()->id;

        $block = Block::firstOrCreate([
            'name' => 'services',
        ]);

        $block->config = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
        ];
        $block->active = (bool) $request->active;
        $block->save();

        DB::transaction(function () use ($request, $tenantId, $block) {
            // Get existing service IDs
            $existingIds = Service::where('tenant_id', $tenantId)->pluck('id')->toArray();
            $submittedIds = collect($request->services)->pluck('id')->filter()->toArray();
            
            // Delete services that are no longer in the request
            $servicesToDelete = array_diff($existingIds, $submittedIds);
            if (!empty($servicesToDelete)) {
                Service::whereIn('id', $servicesToDelete)->delete();
            }
            
            // Update or create services
            foreach ($request->services as $serviceIndex => $serviceData) {
                $serviceId = data_get($serviceData, 'id');
                
                if ($serviceId) {
                    // Update existing service
                    $service = Service::where('id', $serviceId)
                        ->where('tenant_id', $tenantId)
                        ->first();
                    
                    if ($service) {
                        $service->update([
                            'name' => data_get($serviceData, 'name'),
                            'subtitle' => data_get($serviceData, 'subtitle'),
                            'detail' => data_get($serviceData, 'detail'),
                            'price' => $this->convertPriceToCents(data_get($serviceData, 'price')), // Convert to cents
                            'icon' => $this->normalizeIcon(data_get($serviceData, 'icon')),
                            'image' => data_get($serviceData, 'image'),
                            'active' => (bool) data_get($serviceData, 'active', true),
                            'sort' => $serviceIndex,
                        ]);
                    }
                } else {
                    // Create new service
                    $service = Service::create([
                        'tenant_id' => $tenantId,
                        'block_id' => $block->id,
                        'name' => data_get($serviceData, 'name'),
                        'subtitle' => data_get($serviceData, 'subtitle'),
                        'detail' => data_get($serviceData, 'detail'),
                        'price' => $this->convertPriceToCents(data_get($serviceData, 'price')), // Convert to cents
                        'icon' => $this->normalizeIcon(data_get($serviceData, 'icon')),
                        'image' => data_get($serviceData, 'image'),
                        'active' => (bool) data_get($serviceData, 'active', true),
                        'sort' => $serviceIndex,
                    ]);
                }

                // Handle addons for this service
                if ($service) {
                    $addons = data_get($serviceData, 'addons', []);
                    $existingAddonIds = ServiceAddon::where('service_id', $service->id)->pluck('id')->toArray();
                    $submittedAddonIds = collect($addons)->pluck('id')->filter()->toArray();
                    
                    // Delete addons that are no longer in the request
                    $addonsToDelete = array_diff($existingAddonIds, $submittedAddonIds);
                    if (!empty($addonsToDelete)) {
                        ServiceAddon::whereIn('id', $addonsToDelete)->delete();
                    }
                    
                    // Update or create addons
                    foreach ($addons as $addonIndex => $addonData) {
                        $addonId = data_get($addonData, 'id');
                        
                        if ($addonId) {
                            // Update existing addon
                            ServiceAddon::where('id', $addonId)
                                ->where('service_id', $service->id)
                                ->update([
                                    'name' => data_get($addonData, 'name'),
                                    'price' => $this->convertPriceToCents(data_get($addonData, 'price')), // Convert to cents
                                    'active' => (bool) data_get($addonData, 'active', true),
                                    'sort' => $addonIndex,
                                ]);
                        } else {
                            // Create new addon
                            ServiceAddon::create([
                                'service_id' => $service->id,
                                'name' => data_get($addonData, 'name'),
                                'price' => (int) round(data_get($addonData, 'price', 0) * 100), // Convert to cents
                                'active' => (bool) data_get($addonData, 'active', true),
                                'sort' => $addonIndex,
                            ]);
                        }
                    }
                }
            }
        });

        // Return updated data
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

        
        return response()->json([
            'message' => 'Services updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'services' => $services,
            ],
        ]);
    }

    public function getValidationMessages(): array
    {
        return [
            'services.*.name.required' => 'الرجاء إدخال اسم الخدمة',
            'services.*.price.numeric' => 'السعر يجب أن يكون رقماً',
            'services.*.addons.*.name.required' => 'الرجاء إدخال اسم الإضافة',
            'services.*.addons.*.price.numeric' => 'السعر الإضافي يجب أن يكون رقماً',
        ];
    }

    public function getValidationAttributes(): array
    {
        return [
            'services.*.name' => 'اسم الخدمة',
            'services.*.subtitle' => 'العنوان الفرعي',
            'services.*.detail' => 'التفاصيل',
            'services.*.price' => 'السعر',
            'services.*.icon' => 'الأيقونة',
            'services.*.image' => 'الصورة',
            'services.*.active' => 'الحالة',
            'services.*.addons.*.name' => 'اسم الإضافة',
            'services.*.addons.*.price' => 'السعر الإضافي',
        ];
    }
}

