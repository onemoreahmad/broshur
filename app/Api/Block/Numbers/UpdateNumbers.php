<?php

namespace App\Api\Block\Numbers;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateNumbers
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['nullable', 'boolean'],
            'title' => ['nullable', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'items' => ['nullable', 'array'],
            'items.*.icon' => ['nullable', 'string'],
            'items.*.title' => ['required', 'string', 'max:200'],
            'items.*.number' => ['required', 'string', 'max:50'],
            'items.*.active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'numbers']);

        $sanitized = collect($request->items)->map(function ($item) {
            return [
                'icon' => data_get($item, 'icon'),
                'title' => data_get($item, 'title'),
                'number' => data_get($item, 'number'),
                'active' => (bool) data_get($item, 'active', true),
            ];
        })->values()->all();
 
        $block->config = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'items' => $sanitized,
        ];
        $block->active = (bool) $request->active;
        $block->save();

        return response()->json([
            'message' => 'Numbers block updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'items' => $block->config['items'],
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'title' => 'عنوان القسم',
            'subtitle' => 'العنوان الفرعي',
            'items' => 'الإحصائيات',
            'items.*.icon' => 'الأيقونة',
            'items.*.title' => 'العنوان',
            'items.*.number' => 'الرقم',
            'items.*.active' => 'الحالة',
        ];
    }
}

