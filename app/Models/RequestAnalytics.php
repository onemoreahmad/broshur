<?php

namespace App\Models;
 
use App\Traits\Tenantable;

class RequestAnalytics extends  \MeShaon\RequestAnalytics\Models\RequestAnalytics
{
    use Tenantable;
}
