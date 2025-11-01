<?php

namespace App\Api\Block\About;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateAbout
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
            'title' => ['nullable', 'min:1', 'max:255'],
            'text' => ['nullable', 'required_if:active,true', 'min:3', 'max:2000'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'about']);
        
        $block->config = [
            'title' => $request->title,
            'text' => $request->text,
        ];
        $block->active = (bool) $request->active;
        $block->save();

        return response()->json([
            'message' => 'About block updated successfully',
            'data' => [
                'title' => $block->config['title'],
                'text' => $block->config['text'],
                'active' => (bool) $block->active,
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'title' => 'العنوان',
            'text' => 'النص',
            'active' => 'الحالة',
        ];
    }
}
