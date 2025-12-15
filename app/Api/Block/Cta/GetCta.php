<?php

namespace App\Api\Block\Cta;

use App\Models\Block;
use App\Models\Link;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCta
{
    use AsAction;

    public function handle()
    {
        $block = Block::firstOrCreate(['name' => 'cta']);
      
 
        // Get all CTA links ordered by sort
        $links = Link::where('block_id', $block->id)
            ->where('type', 'cta')
            ->whereNotIn('slug', ['contact']) // hide contact link for now
            ->orderBy('sort')
            ->get();
        
        // Build response data
        $data = [
            'active' => (bool) $block->active,
        ];
        
        // Process each link
        $customLinks = [];
        foreach ($links as $link) {
            if ($link->slug === 'whatsapp') {
                $data['whatsapp_enabled'] = (bool) $link->active;
                $data['whatsapp_number'] = $link->link;
                $data['whatsapp_message'] = data_get($link->meta, 'message', '');
                $data['whatsapp_sort'] = $link->sort;
            } elseif ($link->slug === 'contact') {
                $data['contact_enabled'] = (bool) $link->active;
                $data['contact_email'] = $link->link;
                $data['contact_subject'] = data_get($link->meta, 'subject', '');
                $data['contact_sort'] = $link->sort;
            } elseif ($link->slug === 'phone') {
                $data['phone_enabled'] = (bool) $link->active;
                $data['phone_number'] = $link->link;
                $data['phone_sort'] = $link->sort;
            } elseif ($link->slug === 'download') {
                $data['download_enabled'] = (bool) $link->active;
                $data['download_file_url'] = $link->link;
                $data['download_file_name'] = data_get($link->meta, 'file_name', '');
                $data['download_label'] = data_get($link->meta, 'label', '');
                $data['download_sort'] = $link->sort;
            } elseif ($link->slug === 'subscription') {
                $data['subscription_enabled'] = (bool) $link->active;
                $data['subscription_sort'] = $link->sort;
                $data['subscription_message'] = data_get($link->meta, 'message', '');
            } else {
                // Custom links (not whatsapp, contact, phone, download, or subscription)
                $customLinks[] = [
                    'id' => $link->id,
                    'url' => $link->link,
                    'label' => data_get($link->meta, 'label', ''),
                    'active' => (bool) $link->active,
                    'sort' => $link->sort,
                ];
            }
        }
        
        $data['custom_links'] = $customLinks;
        
        // Set defaults if links don't exist
        if (!isset($data['whatsapp_enabled'])) {
            $data['whatsapp_enabled'] = false;
            $data['whatsapp_number'] = '';
            $data['whatsapp_message'] = '';
            $data['whatsapp_sort'] = 1;
        }
        if (!isset($data['contact_enabled'])) {
            $data['contact_enabled'] = false;
            $data['contact_email'] = '';
            $data['contact_subject'] = '';
            $data['contact_sort'] = 2;
        }
        if (!isset($data['phone_enabled'])) {
            $data['phone_enabled'] = false;
            $data['phone_number'] = '';
            $data['phone_sort'] = 3;
        }
        if (!isset($data['download_enabled'])) {
            $data['download_enabled'] = false;
            $data['download_file_url'] = '';
            $data['download_file_name'] = '';
            $data['download_label'] = '';
            $data['download_sort'] = 5;
        }
        if (!isset($data['subscription_enabled'])) {
            $data['subscription_enabled'] = false;
            $data['subscription_sort'] = 4;
            $data['subscription_message'] = '';
        }
        
        return response()->json([
            'data' => $data,
        ]);
    }
}
