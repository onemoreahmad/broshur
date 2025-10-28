<?php

namespace App\Api\Block\Portfolio;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePortfolio
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
            'items' => ['required', 'array'],
            'items.*.image' => ['required', 'string', 'max:1024'],
            'items.*.caption' => ['nullable', 'string', 'max:255'],
            'items.*.active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'portfolio']);
        
        $sanitized = collect($request->items)->map(function ($item) {
            return [
                'image' => data_get($item, 'image'),
                'caption' => data_get($item, 'caption'),
                'active' => (bool) data_get($item, 'active', true),
            ];
        })->values()->all();

        $block->active = (bool) $request->active;
        $block->config = [
            'items' => $sanitized,
        ];
        $block->save();

        return response()->json([
            'message' => 'Portfolio block updated successfully',
            'data' => [
                'active' => $block->active,
                'items' => $block->config['items'],
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'active' => 'تفعيل القسم',
            'items' => 'العناصر',
            'items.*.image' => 'الصورة',
            'items.*.caption' => 'الوصف',
            'items.*.active' => 'الحالة',
        ];
    }
}


