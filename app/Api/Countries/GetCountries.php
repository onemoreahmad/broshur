<?php

namespace App\Api\Countries;

use Lorisleiva\Actions\Concerns\AsAction;

class GetCountries
{
    use AsAction;

    public function handle()
    {
        $countries = require resource_path('lang/ar/countries.php');
        
        return response()->json([
            'data' => $countries,
        ]);
    }
}

