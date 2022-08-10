<?php

namespace App\Model;

use App\Traits\gerNumPvdTrait;
use Illuminate\Database\Eloquent\Model;

class ContractProvider extends Model
{
    use gerNumPvdTrait;

    protected $table = 'tb_contracts_providers';

    protected $dates = ['contract_date','contract_date_start','contract_date_end'];

    protected $fillable = [
        'provider_id',
        'contract_previous_id',
        'active',
        'type_id',
        'contract_num',
        'contract_date',
        'contract_date_start',
        'contract_date_end',
        'contract_comments',
        'payment_day',
        'payment_option_id'
    ];

    public function provider()
    {
        // 1:1
        return $this->hasOne(Provider::class,'id','provider_id');
    }

    public function contractService()
    {
        // 1:N
        return $this->hasMany(ContractPvdService::class,'contract_id','id');
    }

    public function contractScale()
    {
        // N:1
        return $this->belongsTo(ContractPvdScale::class);
    }

    /* REFs */
    public function type()
    {
        // 1:1
        return $this->hasOne(RefContractPvdType::class,'id','type_id');
    }

    public function paymentOption()
    {
        // 1:1
        return $this->hasOne(RefPaymentPvdOption::class,'id','payment_option_id');
    }
}
