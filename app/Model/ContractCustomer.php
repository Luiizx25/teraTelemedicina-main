<?php

namespace App\Model;

use App\Traits\BooleanTrait;
use App\Traits\gerNumTrait;
use Illuminate\Database\Eloquent\Model;

class ContractCustomer extends Model
{
    use BooleanTrait;

    use gerNumTrait;

    protected $table = 'tb_contracts_customers';

    protected $dates = ['contract_date','contract_date_start','contract_date_end'];

    protected $fillable = [
        'contract_previous_id',
        'active',
        'type_id',
        'contract_num',
        'contract_date',
        'contract_date_start',
        'contract_date_end',
        'contract_volume_free',
        'contract_comments',
        'invoice_day',
        'invoice_pay_option_id'
    ];

    public function customer()
    {
        // 1:1
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function contractService()
    {
        // 1:N
        return $this->hasMany(ContractCusService::class,'contract_id','id');
    }

    public function contractCycle()
    {
        // 1:N
        return $this->hasMany(ContractCusCycle::class,'contract_id','id');
    }

    public function Additives()
    {
        // 1:N
        return $this->hasMany(ContractCustomerAdditive::class,'contract_id','id');
    }

    /* REF */
    public function type()
    {
        // 1:1
        return $this->hasOne(RefContractCusType::class,'id','type_id');
    }

    public function payOption()
    {
        // 1:1
        return $this->hasOne(RefInvoicePayOption::class,'id','invoice_pay_option_id');
    }

}
