<?php

namespace App\Api\Block\Header;

use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateHeader
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:150'],
            'slogan' => ['nullable', 'min:1', 'max:255'],
            'newLogo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:6048'],
            'newCover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:6048'],
        ];
    }

    public function handle(Request $request)
    {
        $block = Block::firstOrCreate(['name'=> 'header']);
        // $block->convert_uudecode = $request->cover;
 
        // $block->save();

        // update tenant
        tenant()->name = $request->name;
        tenant()->meta->set('slogan.'.app()->getLocale(), $request->slogan);
        if ($request->hasFile('newLogo')) {
            tenant()->logo = $request->newLogo->store('logo');
        }
       
        // tenant()->logo = $request->newLogo ? $request->newLogo : null;
        tenant()->save();

        return response()->json([
            'message' => 'Block updated successfully',
            'data' => [
                'name' => currentTenant()->name,
                'slogan' => data_get(currentTenant(), 'meta.slogan.'.app()->getLocale()),
                'logo' => data_get(currentTenant(), 'logo'),
                'cover' => data_get($block, 'config.cover'),
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'newLogo' => 'الشعار',
        ];
    }
}
