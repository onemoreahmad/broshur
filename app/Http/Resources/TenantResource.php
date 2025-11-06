<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at->format('Y-m-d'),
            'active' => $this->active,
            'handle' => $this->handle,
            'theme_id' => $this->theme_id,
            'logo' => $this->logo,
            'storefront_url' => $this->storefront_url,
            'site_url' => $this->storefront_url,
            'preview_url' => $this->preview_url,
            'country' => $this->country,
            'city' => $this->city,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
