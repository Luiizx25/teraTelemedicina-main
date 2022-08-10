<?php

namespace App\Model;

use App\Traits\BooleanTrait;
use App\Traits\MoneyTrait;
use Illuminate\Database\Eloquent\Model;

class ContractCusService extends Model
{
    use BooleanTrait;
    use MoneyTrait;

    protected $table = 'tb_contracts_cus_services';

    protected $fillable = [
        'contract_id',
        'service_id',
        'active',
        'service_negotiated_amount',
        'service_negotiated_price',
        'service_negotiated_price_over',
        'service_negotiated_time_estimated',
        'service_negotiated_comments',
    ];

    public function contract()
    {
        // 1:1
        return $this->hasOne(ContractCustomer::class);
    }

    public function service()
    {
        // 1:1
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function contractCycle()
    {
        // 1:1
        return $this->hasOne(ContractCusCycle::class);
    }
}
