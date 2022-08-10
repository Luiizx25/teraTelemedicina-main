<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;
    protected $table = 'tb_financial';
    
    protected $dates = ['item_run_datetime','item_start_datetime','item_conclusion_datetime','finished_at','financial_cycle'];


    protected $fillable = [
        'customer_id',
        'user_id',
        'contract_cycle_id',
        'financial_cycle',
        'status_id',
        'type_id',
        'order_num',
        'order_num_cus',
        'order_comments',
        'order_description',
        'patient_id',
        'pat_name',
        'order_item_id',
        'finished_at',
        'id_control_item',
        'item_service_id',
        'item_type_id',
        'item_status_id',
        'service_name',
        'item_run_datetime',
        'item_fields',
        'item_conclusion_datetime',
        'item_start_datetime',
        'item_end_datetime',
        'item_conclusion_provider_id',
        'item_conclusion_report_id',
        'item_conclusion_price',
        'item_conclusion_comment',
    ];
}
