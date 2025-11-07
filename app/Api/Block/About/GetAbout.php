<?php

namespace App\Api\Block\About;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAbout
{
    use AsAction;

    public function handle()
    {
        $isLocal = app()->environment('local');

        if ($isLocal) {
            DB::enableQueryLog();
        }

        $block = \App\Models\Block::firstOrCreate(['name' => 'about']);
        
        if ($isLocal && app()->bound('debugbar')) {
            app('debugbar')->addMessage(DB::getQueryLog(), 'getAbout queries');
        }

        return response()->json([
            'data' => [
                'id' => $block->id,
                'title' => data_get($block, 'config.title', ''),
                'text' => data_get($block, 'config.text', ''),
                'active' => (boolean) data_get($block, 'active', true),
            ],
        ]);
    }
}
