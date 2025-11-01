<?php

namespace App\Api\Block\Features;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFeatures
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['nullable', 'boolean'],
            'title' => ['nullable', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'features' => ['nullable', 'array'],
            'features.*.icon' => ['nullable', 'string', 'max:100'],
            'features.*.title' => ['required', 'string', 'max:200'],
            'features.*.description' => ['nullable', 'string', 'max:1000'],
            'features.*.active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'features']);

        $sanitized = collect($request->features)->map(function ($feature) {
            return [
                'icon' => data_get($feature, 'icon'),
                'title' => data_get($feature, 'title'),
                'description' => data_get($feature, 'description'),
                'active' => (bool) data_get($feature, 'active', true),
            ];
        })->values()->all();
 
        $block->config = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'features' => $sanitized,
        ];
        $block->active = (bool) $request->active;
        $block->save();

        return response()->json([
            'message' => 'Features block updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'features' => $block->config['features'],
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'title' => 'عنوان القسم',
            'subtitle' => 'العنوان الفرعي',
            'features' => 'المميزات',
            'features.*.icon' => 'الأيقونة',
            'features.*.title' => 'العنوان',
            'features.*.description' => 'الوصف',
            'features.*.active' => 'الحالة',
        ];
    }
}
