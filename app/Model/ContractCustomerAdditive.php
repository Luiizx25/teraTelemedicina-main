<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractCustomerAdditive extends Model
{
    use HasFactory;

    protected $table = 'tb_contracts_customers_additives';

    protected $dates = ['additive_date'];

    protected $fillable = [
        'user_id',
        'contract_id',
        'additive_date',
        'additive_date_conciliation',
        'contract_old',
        'contract_new',
    ];

    public function Contract()
    {
        // 1:1
        return $this->hasOne(ContractCustomer::class,'id','contract_id');
    }

}
