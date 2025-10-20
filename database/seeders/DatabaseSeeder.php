<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
 
        $this->call(ThemeSeeder::class);
        $this->call(SubscriptionSeeder::class);
 
        User::upsert([
            'id' => 1,
            'current_tenant_id' => 1,
            'name' => 'Ahmad',
            'username' => 'ahmad',
            'email' => 'contact@ahmad.tech',
            'password' => Hash::make('112233'),
        ],'id');

        Tenant::upsert([
            'id' => 1,
            'name' => 'Wjeez',
            'handle' => 'wjeez',
            'user_id' => 1,
            'logo' => asset('assets/images/logo.png'),
            'domain' => 'broshore.com',
            'email' => 'info@broshore.com',
            'phone' => '0543001200',
            'active' => true,
        ], 'id');
    }
}
