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
            'title' => ['nullable', 'min:3', 'max:255'],
            'text' => ['nullable', 'required_if:active,true', 'min:3', 'max:2000'],
        ];
    }
 
    public function getValidationMessages(): array
    {
        return [
            'text.required_if' => 'يجب أن يكون لديك نص للعرض عند تفعيل القسم',
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'about']);
        
        $block->config = [
            'title' => $request->title,
            'text' => $request->text,
        ];
        $block->active = (boolean) $request->active;
        $block->save();

        return response()->json([
            'message' => 'About block updated successfully',
            'data' => [
                'title' => $block->config['title'],
                'text' => $block->config['text'],
                'active' => (boolean) $block->active,
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
