<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SlugTrait;
use App\User;

class Provider extends Model
{
    use SlugTrait;

    protected $table = 'tb_providers';

    protected $fillable = [
        'user_id',
        'active',
        'type_id',
        'pvd_genre',
        'pvd_doc_type',
        'pvd_doc_num',
        'pvd_identity_type',
        'pvd_identity_num',
        'pvd_identity_uf',
        'pvd_name_company',
        'pvd_street',
        'pvd_street_num',
        'pvd_street_complement',
        'pvd_neighborhood',
        'pvd_city',
        'pvd_state',
        'pvd_postalcode',
        'pvd_logo_use',
        'pvd_logo',
        'pvd_signature_use',
        'pvd_signature',
        'pvd_slug',
        'bank_id',
        'bank_agency_num',
        'bank_agency_dv',
        'bank_account_type_id',
        'bank_account_num',
        'bank_account_dv',
        'bank_account_operation',
        'specialty_id',
        'certificate',
    ];

    public function user()
    {
        // 1:1
        return $this->hasOne(User::class,'id','user_id');
    }

    public function customersys()
    {
        // 1:1
        return $this->hasOne(CustomerSys::class,'id','customer_sys_id');
    }

    public function ContractProvider()
    {
        // 1:N
        return $this->hasMany(ContractProvider::class);
    }

    public function type()
    {
        // 1:1
        return $this->hasOne(RefProviderType::class,'id','type_id');
    }

    public function specialty()
    {
        // 1:1
        return $this->hasOne(RefProviderSpecialty::class,'id','specialty_id');
    }

    public function bank()
    {
        // 1:1
        return $this->hasOne(ListBank::class,'id','bank_id');
    }

    public function OrderItems()
    {
        // 1:N
        return $this->hasMany(OrderItem::class,'item_conclusion_provider_id','id');
    }

    public function OrderItemReports()
    {
        // 1:N
        return $this->hasMany(OrderItemReport::class,'provider_id','id');
    }

}
