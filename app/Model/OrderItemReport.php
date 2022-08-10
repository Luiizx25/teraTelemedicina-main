<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItemReport extends Model
{
    protected $table = 'tb_orders_items_reports';

    protected $fillable = [
        'item_id',
        'provider_id',
        'report_type_id',
        'report_status_id',
        'report_cycle',
        'report_results',
        'report_results_comments',
        'report_conclusion',
        'report_comments',
        'report_conclusion_file_name',
        'report_conclusion_file_path',
    ];

    public function OrderItem()
    {
        // 1:1
        return $this->hasOne(OrderItem::class,'id','item_id');
    }

    public function provider()
    {
        // 1:1
        return $this->hasOne(Provider::class,'id','provider_id');
    }

    public function status()
    {
        // 1:1
        return $this->hasOne(RefReportStatus::class,'id','report_status_id');
    }

    public function type()
    {
        // 1:1
        return $this->hasOne(RefReportType::class,'id','report_type_id');
    }

    public function files()
    {
        // 1:N
        return $this->hasMany(OrderItemReportFile::class,'report_id','id');
    }
}
