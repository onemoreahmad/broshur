<?php

namespace App\Api\Block\Cta;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCta
{
    use AsAction;

    public function rules(): array
    {
        return [
            'whatsapp_enabled' => ['required', 'boolean'],
            'whatsapp_number' => ['required_if:whatsapp_enabled,true', 'string', 'max:20'],
            'whatsapp_message' => ['nullable', 'string', 'max:500'],
            'contact_enabled' => ['required', 'boolean'],
            'contact_email' => ['required_if:contact_enabled,true', 'email', 'max:255'],
            'contact_subject' => ['nullable', 'string', 'max:200'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name' => 'cta']);
        
        $block->config = [
            'whatsapp_enabled' => (bool) $request->whatsapp_enabled,
            'whatsapp_number' => $request->whatsapp_number,
            'whatsapp_message' => $request->whatsapp_message,
            'contact_enabled' => (bool) $request->contact_enabled,
            'contact_email' => $request->contact_email,
            'contact_subject' => $request->contact_subject,
        ];
        $block->save();

        return response()->json([
            'message' => 'CTA block updated successfully',
            'data' => [
                'whatsapp_enabled' => $block->config['whatsapp_enabled'],
                'whatsapp_number' => $block->config['whatsapp_number'],
                'whatsapp_message' => $block->config['whatsapp_message'],
                'contact_enabled' => $block->config['contact_enabled'],
                'contact_email' => $block->config['contact_email'],
                'contact_subject' => $block->config['contact_subject'],
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'whatsapp_enabled' => 'تفعيل واتساب',
            'whatsapp_number' => 'رقم واتساب',
            'whatsapp_message' => 'رسالة واتساب',
            'contact_enabled' => 'تفعيل التواصل',
            'contact_email' => 'البريد الإلكتروني',
            'contact_subject' => 'موضوع الرسالة',
        ];
    }
}
