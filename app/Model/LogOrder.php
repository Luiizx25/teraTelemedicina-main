<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LogOrder extends Model
{
    protected $table = 'log_orders';
    
    protected $fillable = [
        'user_id',
        'order_id',
        'order_item_id',
        'occurrence'
    ];
    
    public function orderItem()
    {
        // 1:1
        return $this->hasOne(OrderItem::class,'id','order_item_id');
    }
    
    public function order()
    {
        // 1:1
        return $this->hasOne(Order::class,'id','order_id');
    }

    public function user()
    {
        // 1:1
        return $this->hasOne(User::class,'id','user_id');
    }
}
