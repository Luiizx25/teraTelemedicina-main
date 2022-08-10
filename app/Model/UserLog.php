<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'users_log';
    
    protected $fillable = [
        'ip',
        'user',
        'occurrence'
    ];
}
