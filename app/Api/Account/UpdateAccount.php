<?php

namespace App\Api\Account;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateAccount
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
        ];
    }

    public function handle(Request $request)
    {
        $user = $request->user();
        $data = $request->only(['name', 'email']);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->getRawOriginal('image') && Storage::disk('public')->exists($user->getRawOriginal('image'))) {
                Storage::disk('public')->delete($user->getRawOriginal('image'));
            }
            
            // Store new image
            $data['image'] = $request->file('image')->store('users');
        }
        
        $user->update($data);
        
        return response()->json([
            'message' => 'Account updated successfully',
            'user' => UserResource::make($user->fresh()),
        ]);
    }
}

