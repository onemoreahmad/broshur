<?php

namespace App\Api\Block\Cta;

use App\Models\Block;
use App\Models\Link;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCta
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
            'whatsapp_enabled' => ['nullable', 'boolean'],
            'whatsapp_number' => ['nullable','required_if:whatsapp_enabled,true', 'string', 'max:20'],
            'contact_enabled' => ['nullable', 'boolean'],
            // 'whatsapp_message' => ['nullable', 'string', 'max:500'],
            // 'contact_email' => ['nullable', 'required_if:contact_enabled,true', 'email', 'max:255'],
            // 'contact_subject' => ['nullable', 'string', 'max:200'],
        ];
    }

    public function handle(Request $request)
    {
        $tenantId = currentTenant()->id;
        $block = Block::firstOrCreate(['name' => 'cta']);
        
        // Update block active status
        $block->active = (bool) $request->active;
        $block->save();

        // Get sort values from request or use defaults
        $whatsappSort = $request->whatsapp_sort ?? 1;
        $contactSort = $request->contact_sort ?? 2;

        // Update or create WhatsApp link
        $whatsappLink = Link::updateOrCreate(
            [
                'block_id' => $block->id,
                'type' => 'cta',
                'slug' => 'whatsapp',
            ],
            [
                'tenant_id' => $tenantId,
                'name' => 'whatsapp',
                'link' => $request->whatsapp_number ?? '',
                'active' => (bool) $request->whatsapp_enabled,
                // 'meta' => [
                //     // 'message' => $request->whatsapp_message ?? '',
                // ],
                'sort' => $whatsappSort,
            ]
        );

        // Update or create Contact link
        $contactLink = Link::updateOrCreate(
            [
                'block_id' => $block->id,
                'type' => 'cta',
                'slug' => 'contact',
            ],
            [
                'tenant_id' => $tenantId,
                'name' => 'contact',
                'link' => $request->contact_email ?? tenant('email'),
                'active' => (bool) $request->contact_enabled,
                // 'meta' => [
                //     // 'subject' => $request->contact_subject ?? '',
                // ],
                'sort' => $contactSort,
            ]
        );

        return response()->json([
            'message' => 'CTA block updated successfully',
            'data' => [
                'active' => $block->active,
                'whatsapp_enabled' => $whatsappLink->active,
                'whatsapp_number' => $whatsappLink->link,
                // 'whatsapp_message' => data_get($whatsappLink->meta, 'message', ''),
                'whatsapp_sort' => $whatsappLink->sort,
                'contact_enabled' => $contactLink->active,
                // 'contact_email' => $contactLink->link,
                // 'contact_subject' => data_get($contactLink->meta, 'subject', ''),
                'contact_sort' => $contactLink->sort,
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'active' => 'الحالة',
            'whatsapp_enabled' => 'تفعيل واتساب',
            'whatsapp_number' => 'رقم واتساب',
            // 'whatsapp_message' => 'رسالة واتساب',
            'contact_enabled' => 'تفعيل التواصل',
            'contact_email' => 'البريد الإلكتروني',
            'contact_subject' => 'موضوع الرسالة',
        ];
    }
}
