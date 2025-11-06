<?php

namespace App\Api\Theme;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateThemeOptions
{
    use AsAction;

    public function rules(): array
    {
        return [
            'theme_id' => 'required|exists:themes,id',
            'options' => 'required|array',
        ];
    }

    public function handle(Request $request)
    {
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
    }
}

