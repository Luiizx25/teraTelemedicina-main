<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SlugTrait;


class Customer extends Model
{
    use SlugTrait;

    protected $table = 'tb_customers';

    protected $fillable = [
        'type_id',
        'user_id',
        'customersys_id',
        'cus_doc_type',
        'cus_doc_num',
        'cus_name',
        'cus_name_company',
        'cus_phone',
        'cus_email',
        'cus_street',
        'cus_street_num',
        'cus_street_complement',
        'cus_neighborhood',
        'cus_city',
        'cus_state',
        'cus_postalcode',
        'cus_manager_name',
        'cus_manager_phone',
        'cus_manager_email',
        'cus_financial_name',
        'cus_financial_phone',
        'cus_financial_email',
        'cus_logo_use',
        'cus_logo',
        'cus_slug',
        'bank_id',
        'bank_agency_num',
        'bank_agency_dv',
        'bank_account_type_id',
        'bank_account_operation',
        'bank_account_num',
        'bank_account_dv'
    ];

    public function user()
    {
        // N:N
        return $this->belongsToMany(User::class,'tb_customers_users')->withPivot('financial','tecnical','manager');
    }

    public function customersys()
    {
        // 1:1
        return $this->hasOne(CustomerSys::class,'id','customer_sys_id');
    }

    public function ContractCustomer()
    {
        // 1:N
        return $this->hasMany(ContractCustomer::class);
    }

    public function Order()
    {
        // 1:N
        return $this->hasMany(Order::class,'customer_id','id');
    }

    public function Patient()
    {
        // 1:N
        return $this->hasMany(Patient::class,'customer_id','id');
    }


    /* REFs */
    public function status()
    {
        // 1:1
        return $this->hasOne(RefCustomerStatus::class,'id','status_id');
    }

    public function type()
    {
        // 1:1
        return $this->hasOne(RefCustomerType::class,'id','type_id');
    }

    public function docType()
    {
        // 1:1
        return $this->hasOne(RefDocTypeCus::class,'id','cus_doc_type_id');
    }

    /* LISTs */
    public function bank()
    {
        // 1:1
        return $this->hasOne(ListBank::class,'id','bank_id');
    }
    public function bankAccountType()
    {
        // 1:1
        return $this->hasOne(ListBankAccountType::class,'id','bank_account_type_id');
    }





}
