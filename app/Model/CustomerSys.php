<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CustomerSys extends Model
{
    protected $table = 'tb_customersys';

    public function user()
    {
        // N:N
        return $this->belongsToMany(User::class,'tb_customersys_users','customer_sys_id','user_id');
    }

    public function customer()
    {
        // 1:N
        return $this->hasMany(Customer::class);
    }

    public function provider()
    {
        // 1:N
        return $this->hasMany(Provider::class);
    }

    public function service()
    {
        // 1:N
        return $this->hasMany(Service::class);
    }

    public function serviceType()
    {
        // 1:N
        return $this->hasMany(RefServiceType::class);
    }

    public function serviceCategory()
    {
        // 1:N
        return $this->hasMany(RefServiceCategory::class);
    }

    public function providerType()
    {
        // 1:N
        return $this->hasMany(RefProviderType::class);
    }

    public function providerSpecialty()
    {
        // 1:N
        return $this->hasMany(RefProviderSpecialty::class);
    }
}
