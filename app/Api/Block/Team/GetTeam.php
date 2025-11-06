<?php

namespace App\Api\Block\Team;

use App\Models\Block;
use App\Models\TeamMember;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTeam
{
    use AsAction;

    public function handle()
    {
        $tenantId = currentTenant()->id;
        
        // Get team members for current tenant
        $members = TeamMember::where('tenant_id', $tenantId)
            ->orderBy('sort')
            ->get()
            ->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'job_title' => $member->job_title,
                    'bio' => $member->bio,
                    'image' => $member->image,
                    'image_url' => $member->image_url,
                    'active' => $member->active,
                    'sort' => $member->sort,
                ];
            });

        $block = Block::firstOrCreate([
            'name' => 'team',    
        ],['active' => false]);

        return response()->json([
            'data' => [
                'id' => $block->id,  
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'members' => $members,
            ],
        ]);
    }
}

