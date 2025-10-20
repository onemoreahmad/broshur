<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theme::upsert([
            [
                'slug' => 'default',
                'name' => 'إفتراضي',
            ],
            [
                'slug' => 'light',
                'name' => 'بسيط',
            ],
       
        ],['slug','app','type']);
    }
}
