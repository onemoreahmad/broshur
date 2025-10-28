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
            'title' => ['required', 'min:3', 'max:255'],
            'text' => ['required', 'min:10', 'max:2000'],
            'active' => ['required', 'boolean'],
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
