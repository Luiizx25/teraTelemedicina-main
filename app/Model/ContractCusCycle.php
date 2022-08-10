<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContractCusCycle extends Model
{
    protected $table = 'tb_contracts_cus_cycles';

    protected $fillable = [
        "contract_id",
        "cycle_slug",
        "cycle_month",
        "cycle_year",
        "cycle_date_start",
        "cycle_date_end",
    ];

    protected $dates = [
        "cycle_date_start",
        "cycle_date_end",
    ];

    public function contract()
    {
        // 1:1
        return $this->hasOne(ContractCustomer::class);
    }

    public function cycleService()
    {
        // 1:N
        return $this->hasMany(ContractCusCycleService::class,'cycle_id','id');
    }

    public function orders()
    {
        // 1:N
        return $this->hasMany(Order::class,'contract_cycle_id','id');
    }
}
