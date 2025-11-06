<?php

namespace App\Api\Theme;

use Lorisleiva\Actions\Concerns\AsAction;

class GetThemes
{
    use AsAction;

    public function handle()
    {
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
                    'optionFields' => $theme->optionFields, // Get options from options.json file
                    'tenantOptions' => $theme->tenantOptions,
                ];
            });

        return response()->json([
            'data' => $themes,
        ]);
    }
}

