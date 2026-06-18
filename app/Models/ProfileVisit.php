<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileVisit extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'profile_visits';

    protected $fillable = [
        'user_id',
        'visitor_ip',
    ];
}
