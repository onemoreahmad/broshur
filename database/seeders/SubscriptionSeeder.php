<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LucasDotVin\Soulbscription\Enums\PeriodicityType;
use App\Models\Plan;
use LucasDotVin\Soulbscription\Models\Feature;
use App\Models\Tenant;

class SubscriptionSeeder extends Seeder
{

    public function run(): void
    {
        $basic = Plan::updateOrCreate(
            [
                'slug'             => 'basic',
            ],
            [
                'label'            => 'الباقة المجانية',
                'name'             => 'Basic',
                'periodicity_type' => null,
                'periodicity'      => null,
                'grace_days'       => 7,
                'price'            => 0,
                'is_system'        => true,
            ]
        );

        $plusMonthly = Plan::updateOrCreate(
            [
                'slug'             => 'plus-monthly',
            ],
            [
                'label'            => 'plus',
                'name'             => 'Plus',
                'periodicity_type' => PeriodicityType::Month,
                'periodicity'      => 1,
                'grace_days'       => 7,
                'price'            => 99,
                'is_system'        => true,
            ]
        );

        $plusYearly = Plan::updateOrCreate(
            [
                'slug'             => 'plus-yearly',
            ],
            [
                'label'            => 'plus',
                'name'             => 'Plus',
                'periodicity_type' => PeriodicityType::Year,
                'periodicity'      => 1,
                'grace_days'       => 7,
                'price'            => 99 * 10,
                'is_system'        => true,
            ]
        );

        $proMonthly = Plan::updateOrCreate(
            [
                'slug'             => 'pro-monthly',
            ],
            [
                'label'            => 'pro',
                'name'             => 'Pro',
                'periodicity_type' => PeriodicityType::Month,
                'periodicity'      => 1,
                'grace_days'       => 7,
                'price'            => 199,
                'is_system'       => true,
                'active'       => true,
            ]
        );

        $proYearly = Plan::updateOrCreate(
            [
                'slug'             => 'pro-yearly',
            ],
            [
                'label'            => 'pro',
                'name'             => 'Pro',
                'periodicity_type' => PeriodicityType::Year,
                'periodicity'      => 1,
                'grace_days'       => 7,
                'price'            => 199 * 10,
                'is_system'       => true,
                'active'       => true,
            ]
        );

        $domain  =  Feature::updateOrCreate(
            [
                'name' => 'domain',
            ],
            [
                'consumable' => false,
            ]
        );

        $plusMonthly->features()->syncWithoutDetaching($domain);
        $plusYearly->features()->syncWithoutDetaching($domain);
        $proMonthly->features()->syncWithoutDetaching($domain);
        $proYearly->features()->syncWithoutDetaching($domain);

        $themePages  =  Feature::updateOrCreate(
            [
                'name' => 'theme-pages',
            ],
            [
                'consumable' => false,
            ]
        );

        $plusMonthly->features()->syncWithoutDetaching($themePages);
        $plusYearly->features()->syncWithoutDetaching($themePages);
        $proMonthly->features()->syncWithoutDetaching($themePages);
        $proYearly->features()->syncWithoutDetaching($themePages);
    }
}
