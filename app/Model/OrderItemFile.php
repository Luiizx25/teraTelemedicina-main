<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItemFile extends Model
{
    protected $table = 'tb_orders_items_files';

    protected $fillable = [
        'order_item_id',
        'file_type',
        'file_mime_type',
        'file_size',
        'file_name',
        'file',
        'file_description',
        'file_comments',
    ];

    public function type()
    {
        // 1:1
        return $this->hasOne(RefFileType::class,'slug','file_type');
    }

    public function mimeType()
    {
        // 1:1
        return $this->hasOne(RefFileMimeType::class,'slug','file_mime_type');
    }

    public function orderItem()
    {
        // 1:1
        return $this->hasOne(OrderItem::class,'id','order_item_id');
    }




}
