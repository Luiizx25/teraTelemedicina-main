<?php

namespace App\Model;

use App\Traits\gerNumTrait;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use gerNumTrait;

    protected $table = 'tb_orders_items';

    protected $dates = ['deleted_at','item_run_datetime','item_start_datetime','item_end_datetime','item_conclusion_datetime'];

    protected $fillable = [
        'order_id',
        'id_control',
        'item_num',
        'item_type_id',
        'item_status_id',
        'item_status_id_ant',
        'item_service_id',
        'item_comments',
        'item_run_datetime',
        'item_fields',
        'item_conclusion_datetime',
        'item_conclusion_provider_id',
        'item_conclusion_report_id',
        'item_start_datetime',
        'item_end_datetime',
        'item_conclusion_price',
        'item_conclusion_comment',
        'service_variation_id',
        'chave',
    ];

    public function service()
    {
        // 1:1
        return $this->hasOne(Service::class,'id','item_service_id');
    }

    public function serviceVariation()
    {
        // 1:1
        return $this->hasOne(ServiceVariation::class,'id','service_variation_id');
    }

    public function files()
    {
        // 1:N
        return $this->hasMany(OrderItemFile::class,'order_item_id','id');
    }

    public function reports()
    {
        // 1:N
        return $this->hasMany(OrderItemReport::class,'item_id','id');
    }

    public function order()
    {
        // 1:1
        return $this->hasOne(Order::class,'id','order_id');
    }

    public function provider()
    {
        // 1:1
        return $this->hasOne(Provider::class,'item_conclusion_provider_id','id');
    }

    public function ConclusionReport()
    {
        // 1:1
        return $this->hasOne(OrderItemReport::class,'id','item_conclusion_report_id');
    }
    
    public function ConclusionReportFiles()
    {
        // 1:N
        return $this->hasMany(OrderItemReportFile::class, 'report_id', 'item_conclusion_report_id');
    }

    public function ConclusionProvider()
    {
        // 1:1
        return $this->hasOne(Provider::class,'id','item_conclusion_provider_id');
    }

    /* REFs */
    public function status()
    {
        // 1:1
        return $this->hasOne(RefOrderItemStatus::class,'id','item_status_id');
    }

    public function type()
    {
        // 1:1
        return $this->hasOne(RefOrderItemType::class,'id','item_type_id');
    }

}
