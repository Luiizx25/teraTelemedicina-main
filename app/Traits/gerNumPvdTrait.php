<?php
namespace App\Traits;

use DateTime;

trait gerNumPvdTrait
{
    public function setContractNumAttribute($value)
    {
        $now = new DateTime();

        // TT.CT.PVD.2020.09.<providerId>.<timeStamp>-<type>
        if(empty($this->attributes['contract_num']))
            $this->attributes['contract_num'] = "TT.CT.PVD.".$now->format('Y.m').'.'.$value.'.'.$now->getTimestamp().'-'.$this->attributes['type_id'];
    }
}
