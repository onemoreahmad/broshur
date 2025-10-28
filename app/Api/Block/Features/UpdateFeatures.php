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
            'features' => ['required', 'array'],
            'features.*.icon' => ['required', 'string', 'max:100'],
            'features.*.title' => ['required', 'string', 'max:200'],
            'features.*.description' => ['required', 'string', 'max:1000'],
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
            'features' => $sanitized,
        ];
        $block->save();

        return response()->json([
            'message' => 'Features block updated successfully',
            'data' => [
                'features' => $block->config['features'],
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'features' => 'المميزات',
            'features.*.icon' => 'الأيقونة',
            'features.*.title' => 'العنوان',
            'features.*.description' => 'الوصف',
            'features.*.active' => 'الحالة',
        ];
    }
}
