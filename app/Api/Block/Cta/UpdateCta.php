<?php

namespace App\Api\Block\Cta;

use App\Models\Block;
use App\Models\Link;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\DB;

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
            'subscription_enabled' => ['nullable', 'boolean'],
            'subscription_sort' => ['nullable', 'integer'],
            'subscription_message' => ['nullable', 'string', 'max:500'],
            'custom_links' => ['nullable', 'array'],
            'custom_links.*.id' => ['nullable', 'integer', 'exists:links,id'],
            'custom_links.*.url' => ['required', 'url', 'max:500'],
            'custom_links.*.label' => ['nullable', 'string', 'max:100'],
            'custom_links.*.active' => ['nullable', 'boolean'],
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
        $subscriptionSort = $request->subscription_sort ?? 3;

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

        // Update or create Subscription link
        $subscriptionLink = Link::updateOrCreate(
            [
                'block_id' => $block->id,
                'type' => 'cta',
                'slug' => 'subscription',
            ],
            [
                'tenant_id' => $tenantId,
                'name' => 'subscription',
                'link' => $request->subscription_link ?? '',
                'active' => (bool) $request->subscription_enabled,
                'meta' => [
                    'message' => $request->subscription_message ?? '',
                ],
                'sort' => $subscriptionSort,
            ]
        );

        // Handle custom links
        if ($request->has('custom_links')) {
            DB::transaction(function () use ($request, $tenantId, $block) {
                // Get existing custom link IDs for this block (excluding whatsapp, contact, subscription)
                $existingIds = Link::where('block_id', $block->id)
                    ->where('type', 'cta')
                    ->whereNotIn('slug', ['whatsapp', 'contact', 'subscription'])
                    ->pluck('id')
                    ->toArray();
                $submittedIds = collect($request->custom_links)->pluck('id')->filter()->toArray();
                
                // Delete links that are no longer in the request
                $linksToDelete = array_diff($existingIds, $submittedIds);
                if (!empty($linksToDelete)) {
                    Link::whereIn('id', $linksToDelete)->delete();
                }
                
                // Update or create custom links
                foreach ($request->custom_links as $index => $linkData) {
                    $linkId = data_get($linkData, 'id');
                    $slug = $linkId ? 'custom-' . $linkId : 'custom-' . uniqid();
                    
                    if ($linkId) {
                        // Update existing link
                        Link::where('id', $linkId)
                            ->update([
                                'link' => data_get($linkData, 'url'),
                                'block_id' => $block->id,
                                'meta' => [
                                    'label' => data_get($linkData, 'label', ''),
                                ],
                                'active' => (bool) data_get($linkData, 'active'),
                                'sort' => $index + 100, // Start after whatsapp/contact
                            ]);
                    } else {
                        // Create new link
                        Link::create([
                            'tenant_id' => $tenantId,
                            'type' => 'cta',
                            'name' => 'custom',
                            'slug' => $slug,
                            'link' => data_get($linkData, 'url'),
                            'block_id' => $block->id,
                            'meta' => [
                                'label' => data_get($linkData, 'label', ''),
                            ],
                            'active' => (bool) data_get($linkData, 'active'),
                            'sort' => $index + 100, // Start after whatsapp/contact
                        ]);
                    }
                }
            });
        }

        // Get custom links for response
        $customLinks = Link::where('block_id', $block->id)
            ->where('type', 'cta')
            ->whereNotIn('slug', ['whatsapp', 'contact', 'subscription'])
            ->orderBy('sort')
            ->get()
            ->map(function ($link) {
                return [
                    'id' => $link->id,
                    'url' => $link->link,
                    'label' => data_get($link->meta, 'label', ''),
                    'active' => (bool) $link->active,
                    'sort' => $link->sort,
                ];
            });

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
                'subscription_enabled' => $subscriptionLink->active,
                'subscription_sort' => $subscriptionLink->sort,
                'subscription_message' => data_get($subscriptionLink->meta, 'message', ''),
                'custom_links' => $customLinks,
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
            'subscription_message' => 'رسالة الاشتراك',
            'custom_links' => 'الروابط المخصصة',
            'custom_links.*.url' => 'رابط',
            'custom_links.*.label' => 'التسمية',
            'custom_links.*.active' => 'الحالة',
        ];
    }
}
