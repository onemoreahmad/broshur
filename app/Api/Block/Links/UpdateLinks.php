<?php

namespace App\Api\Block\Links;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateLinks
{
    use AsAction;

    public function rules(): array
    {
        return [
            'links' => ['required', 'array'],
            'links.*.url' => ['required', 'url', 'max:500'],
            'links.*.network' => ['required', 'string', 'max:50'],
            'links.*.label' => ['nullable', 'string', 'max:100'],
            'links.*.active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'links']);
        
        $sanitized = collect($request->links)->map(function ($link) {
            return [
                'url' => data_get($link, 'url'),
                'network' => data_get($link, 'network'),
                'label' => data_get($link, 'label'),
                'active' => (bool) data_get($link, 'active', true),
            ];
        })->values()->all();

        $block->config = [
            'links' => $sanitized,
        ];
        $block->save();

        return response()->json([
            'message' => 'Links updated successfully',
            'data' => [
                'links' => $block->config['links'],
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'links' => 'الروابط',
            'links.*.url' => 'رابط',
            'links.*.network' => 'الشبكة الاجتماعية',
            'links.*.label' => 'التسمية',
        ];
    }
}
