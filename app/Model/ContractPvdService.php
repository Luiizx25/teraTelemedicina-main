<?php

namespace App\Model;

use App\Traits\MoneyTrait;
use Illuminate\Database\Eloquent\Model;

class ContractPvdService extends Model
{
    use MoneyTrait;

    protected $table = 'tb_contracts_pvd_services';

    protected $fillable = [
        'contract_id',
        'service_id',
        'active',
        'service_negotiated_price',
        'service_negotiated_time_estimated',
        'service_negotiated_comments',
    ];

    public function contract()
    {
        // 1:1
        return $this->hasOne(ContractProvider::class, 'id', 'contract_id');
    }

    public function service()
    {
        // 1:1
        return $this->hasOne(Service::class,'id','service_id');
    }
}
