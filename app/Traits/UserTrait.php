<?php
namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait UserTrait
{
    public function setPasswordAttribute($value)
    {
        if( Hash::needsRehash($value) ) {
            $value = Hash::make($value);
        }

        $this->attributes['password'] = $value;
        //$this->attributes['password'] = Hash::make($value);
    }

    public function setActiveAttribute($value)
    {
        if(in_array($value,[1,'1',true,'true',null]))
            $this->attributes['active'] = 1;
        else
            $this->attributes['active'] = 0;
    }
}
