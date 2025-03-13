<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'page_url',
        'visitor_id',
        'ip_address',
        'user_agent',
        'referrer',
        'visit_time'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
