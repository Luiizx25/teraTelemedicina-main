<?php
namespace App\Traits;

trait TimeTrait
{
    public function setServiceTimeEstimatedAttribute($value)
    {
        $this->attributes['service_time_estimated'] = date('h:i:A', strtotime($value));
    }

    public function setServicePvdTimeEstimatedAttribute($value)
    {
        $this->attributes['service_pvd_time_estimated'] = date('h:i:A', strtotime($value));
    }
}
