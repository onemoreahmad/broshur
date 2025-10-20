<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;
use App\Models\Client;
use App\Traits\Tenantable;
use App\Models\User;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Payment extends Model
{
    use HasShortflakePrimary, Tenantable, HasStatuses;

    public $casts = [
        'meta' => 'json',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getStatusLabelAttribute()
    {
        return $this->status() ?: __($this->initial_status);
    }
    
    public function getWhoAttribute()
    {
        if ($this->user_id) {
            return $this->user->name . ' ' . ($this->source_name ? '(' . $this->source_name . ')' : '');
        }

        if ($this->client_id) {
            return $this->client->name . ' ' . ($this->source_name ? '(' . $this->source_name . ')' : '');
        }

        return '-';
    }
}
