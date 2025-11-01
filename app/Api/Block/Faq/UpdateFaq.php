<?php

namespace App\Api\Block\Faq;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFaq
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['nullable', 'boolean'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['nullable', 'string', 'max:500'],
            'faqs.*.answer' => ['nullable',   'string', 'max:2000'],
            'faqs.*.active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'faq']);
        
        $sanitized = collect($request->faqs)->map(function ($faq) {
            return [
                'question' => data_get($faq, 'question'),
                'answer' => data_get($faq, 'answer'),
                'active' => (bool) data_get($faq, 'active', true),
            ];
        })->values()->all();

        $block->config = [
            'faqs' => $sanitized,
        ];
        $block->active = (bool) $request->active;
        $block->save();

        return response()->json([
            'message' => 'FAQ block updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'faqs' => $block->config['faqs'],
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'faqs' => 'الأسئلة الشائعة',
            'faqs.*.question' => 'السؤال',
            'faqs.*.answer' => 'الإجابة',
            'faqs.*.active' => 'الحالة',
        ];
    }
}
