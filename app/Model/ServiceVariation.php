<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceVariation extends Model
{
    protected $table = 'tb_services_variations';

    protected $fillable = [
        'service_id',
        'variation_name',
        'slug',
    ];

    public function service()
    {
        // 1:1
        return $this->hasOne(Service::class,'id','service_id');
    }
}
