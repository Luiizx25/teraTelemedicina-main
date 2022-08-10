<?php
namespace App\Traits;

use Carbon\Carbon;

trait gerNumTrait
{
    public function setContractNumAttribute($value)
    {
        $now = Carbon::now();

        if(empty($this->attributes['contract_num']))
            $this->attributes['contract_num'] = "TT.CT.".$now->format('Y.m').'.'.$value.'.'.$now->getTimestamp().'-'.$this->attributes['type_id']; // TT.CT.2020.09.1001.123456789-1
    }

    public function setOrderNumAttribute($value)
    {
        $now = Carbon::now();

        if(empty($this->attributes['order_num']))
            $this->attributes['order_num'] = "TT.OD.".$now->format('Y-m').'.'.$value.'.'.$this->attributes['patient_id'].'.'.$now->getTimestamp().'-'.$this->attributes['type_id']; // TT.OD.2020-09.<customerId>.<patientId>.123456789-1
    }

    public function setItemNumAttribute($value)
    {
        $now = Carbon::now();

        if(empty($this->attributes['item_num'])) // $value = send patient_id
            $this->attributes['item_num'] = ($value??'ND').'.'.$this->attributes['item_service_id'].'.'.$this->attributes['id_control']; // <patient_id>.<item_service_id>.123456789
    }
}
