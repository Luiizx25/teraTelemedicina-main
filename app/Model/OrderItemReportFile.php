<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItemReportFile extends Model
{
    protected $table = 'tb_orders_items_reports_files';
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'deleted_at',
        'report_id',
        'file_type',
        'file',
        'file_description',
        'file_comments',
    ];
}
