<?php

namespace App\Api\Block\Agreement;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateAgreement
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
            'agreement_title' => ['nullable', 'min:3', 'max:255'],
            'agreement_content' => ['nullable', 'required_if:active,true', 'min:3', 'max:5000'],
        ];
    }
 
    public function getValidationMessages(): array
    {
        return [
            'agreement_content.required_if' => 'يجب أن يكون لديك محتوى اتفاقية وسياسة الخصوصية للعرض عند تفعيل القسم',
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'agreement']);
        
        $block->config = [
            'agreement_title' => $request->agreement_title,
            'agreement_content' => $request->agreement_content,
        ];
        $block->active = (boolean) $request->active;
        $block->save();

        return response()->json([
            'message' => 'Agreement block updated successfully',
            'data' => [
                'agreement_title' => $block->config['agreement_title'],
                'agreement_content' => $block->config['agreement_content'],
                'active' => (boolean) $block->active,
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'agreement_title' => 'عنوان الاتفاقية',
            'agreement_content' => 'محتوى الاتفاقية',
            'active' => 'الحالة',
        ];
    }
}

