<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContractPvdScale extends Model
{
    protected $table = 'tb_contracts_pvd_scales';

    public function contract()
    {
        // 1:1
        return $this->hasOne(ContractProvider::class);
    }
}
