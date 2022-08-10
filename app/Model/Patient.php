<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Patient extends Model
{
    protected $table = 'tb_patients';

    protected $dates = ['pat_date_birth'];

    protected $fillable = [
        'user_id',
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

    public function order()
    {
        // 1:N
        return $this->hasMany(Order::class,'patient_id','id');
    }



}
