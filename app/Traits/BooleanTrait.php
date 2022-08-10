<?php
namespace App\Traits;

trait BooleanTrait
{
    public function setActiveAttribute($value)
    {
        if(in_array($value , ['S','s','1',1] ))
            $this->attributes['active'] = true;
        else
            $this->attributes['active'] = false;
    }

    public function setContractVolumeFreeAttribute($value)
    {
        if(in_array($value , ['S','s','1',1] ))
            $this->attributes['contract_volume_free'] = true;
        else
            $this->attributes['contract_volume_free'] = false;
    }
}
