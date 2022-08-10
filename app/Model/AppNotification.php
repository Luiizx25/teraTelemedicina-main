<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class AppNotification extends Model
{
    use HasFactory;
    protected $table = 'tb_app_notification';

    protected $fillable = [
        'user_id',
        'send'
    ];

    public function user()
    {
        // 1:1
        return $this->hasOne(User::class,'user_id','id');
    }
}
