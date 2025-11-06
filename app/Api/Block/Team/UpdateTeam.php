<?php

namespace App\Api\Block\Team;

use App\Models\Block;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTeam
{
    use AsAction;

    public function rules(): array
    {
        return [
            'members' => ['nullable', 'array'],
            'members.*.id' => ['nullable', 'integer', 'exists:team_members,id'],
            'members.*.name' => ['required', 'string', 'max:255'],
            'members.*.job_title' => ['required', 'string', 'max:255'],
            'members.*.bio' => ['nullable', 'string', 'max:1000'],
            'members.*.image' => ['nullable', 'string', 'max:1024'],
            'members.*.active' => ['nullable', 'boolean'],
            'active' => ['nullable', 'boolean'],
            'title' => ['nullable', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function handle(Request $request)
    {
        $tenantId = currentTenant()->id;

        $block = Block::firstOrCreate([
            'name' => 'team',
        ]);

        $block->config = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
        ];
        $block->active = (bool) $request->active;
        $block->save();

        DB::transaction(function () use ($request, $tenantId, $block) {
            // Get existing member IDs
            $existingIds = TeamMember::where('tenant_id', $tenantId)->pluck('id')->toArray();
            $submittedIds = collect($request->members)->pluck('id')->filter()->toArray();
            
            // Delete members that are no longer in the request
            $membersToDelete = array_diff($existingIds, $submittedIds);
            if (!empty($membersToDelete)) {
                TeamMember::whereIn('id', $membersToDelete)->delete();
            }
            
            // Update or create members
            foreach ($request->members as $index => $memberData) {
                $memberId = data_get($memberData, 'id');
                
                if ($memberId) {
                    // Update existing member
                    TeamMember::where('id', $memberId)
                        ->where('tenant_id', $tenantId)
                        ->update([
                            'name' => data_get($memberData, 'name'),
                            'job_title' => data_get($memberData, 'job_title'),
                            'bio' => data_get($memberData, 'bio'),
                            'image' => data_get($memberData, 'image'),
                            'active' => (bool) data_get($memberData, 'active', true),
                            'sort' => $index,
                        ]);
                } else {
                    // Create new member
                    TeamMember::create([
                        'tenant_id' => $tenantId,
                        'block_id' => $block->id,
                        'name' => data_get($memberData, 'name'),
                        'job_title' => data_get($memberData, 'job_title'),
                        'bio' => data_get($memberData, 'bio'),
                        'image' => data_get($memberData, 'image'),
                        'active' => (bool) data_get($memberData, 'active', true),
                        'sort' => $index,
                    ]);
                }
            }
        });

        // Return updated data
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

        
        return response()->json([
            'message' => 'Team updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'members' => $members,
            ],
        ]);
    }

    public function getValidationMessages(): array
    {
        return [
            'members.*.name.required' => 'الرجاء إدخال اسم العضو',
            'members.*.job_title.required' => 'الرجاء إدخال المسمى الوظيفي',
            'members.*.bio.string' => 'الرجاء إدخال سيرة ذاتية صالحة',
            'members.*.image.string' => 'الرجاء إدخال صورة صالحة',
        ];
    }

    public function getValidationAttributes(): array
    {
        return [
            'members.*.name' => 'الاسم',
            'members.*.job_title' => 'المسمى الوظيفي',
            'members.*.bio' => 'السيرة الذاتية',
            'members.*.image' => 'الصورة',
            'members.*.active' => 'الحالة',
        ];
    }
}

