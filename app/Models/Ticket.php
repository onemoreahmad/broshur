<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Tenantable;

class Ticket extends Model
{
    use SoftDeletes, Tenantable;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'subject',
        'message',
        'status',
        'priority',
        'attachments',
        'closed_at',
    ];

    protected $casts = [
        'attachments' => 'array',
        'closed_at' => 'datetime',
    ];



    public function replies()
    {
        return $this->hasMany(TicketReply::class)->orderBy('id', 'asc');
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'open' => 'green',
            'pending' => 'yellow',
            'closed' => 'gray',
            default => 'gray',
        };
    }

    public function getPriorityLabelAttribute()
    {
        return match($this->priority) {
            1 => 'منخفض',
            2 => 'متوسط',
            3 => 'عالي',
            default => 'منخفض',
        };
    }
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
 