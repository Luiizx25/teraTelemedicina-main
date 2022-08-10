<?php

namespace App\Model;

use App\Traits\gerNumTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use gerNumTrait;

    protected $table = 'tb_orders';

    protected $dates = ['deleted_at','pat_date_birth'];

    protected $fillable = [
        'customer_id',
        'contract_cycle_id',
        'id_control',
        'user_id',
        'type_id',
        'status_id',
        'order_num',
        'order_num_cus',
        'order_comments',
        'order_description',
        'patient_id',
        'pat_doc_type',
        'pat_doc_num',
        'pat_identity_num',
        'pat_identity_emitting',
        'pat_name',
        'pat_date_birth',
        'pat_genre',
        'pat_phone_mobile',
        'pat_phone',
        'pat_email',
        'pat_street',
        'pat_street_num',
        'pat_street_complement',
        'pat_street_neighborhood',
        'pat_city',
        'pat_state',
        'pat_postalcode',
        'pat_work_company',
        'pat_work_position',
        'pat_weight',
        'pat_height',
        'pat_comments',
    ];


    public function user()
    {
        // 1:1
        return $this->hasOne(User::class,'id','user_id');
    }

    public function customer()
    {
        // 1:1
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function patient()
    {
        // 1:1
        return $this->hasOne(Patient::class,'id','patient_id');
    }

    public function itens()
    {
        // 1:N
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    public function contractCycle()
    {
        // 1:1
        return $this->hasOne(ContractCusCycle::class,'id','contract_cycle_id');
    }


    /* REFs */
    public function status()
    {
        // 1:1
        return $this->hasOne(RefOrderStatus::class,'id','status_id');
    }

    public function type()
    {
        // 1:1
        return $this->hasOne(RefOrderType::class,'id','type_id');
    }







}
