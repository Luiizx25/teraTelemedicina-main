<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServicePreResponse extends Model
{
    protected $table = 'tb_services_preresponses';

    protected $fillable = [
        'service_id',
        'title',
        'description',
        'body',
        'slug',
    ];

    public function service()
    {
        // 1:1
        return $this->hasOne(Service::class,'id','service_id');
    }

}
