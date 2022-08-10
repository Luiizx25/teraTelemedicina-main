<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContractCusCycleService extends Model
{
    protected $table = 'tb_contracts_cus_cycles_services';

    protected $fillable = [
        "cycle_id",
        "service_id",
        "cycle_amount_negotiated",
        "cycle_amount_available",
        "cycle_time_estimated",
        "cycle_negotiated_price",
        "cycle_negotiated_price_over",
    ];

    public function cycle()
    {
        // 1:1
        return $this->hasOne(ContractCusCycle::class);
    }

    public function service()
    {
        // 1:1
        return $this->hasOne(Service::class,'id','service_id');
    }
}
