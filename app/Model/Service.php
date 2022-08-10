<?php

namespace App\Model;

use App\Traits\BooleanTrait;
use App\Traits\MoneyTrait;
use App\Traits\SlugTrait;
use App\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use SlugTrait;
    use BooleanTrait;
    use MoneyTrait;
    //use TimeTrait;

    protected $table = 'tb_services';

    protected $fillable = [
        'service_name',
        'service_description',
        'category_id',
        'active',
        'type_id',
        'service_price',
        'service_price_over',
        'service_time_estimated',
        'service_slug',
        'service_pvd_price',
        'service_pvd_price_over',
        'service_pvd_time_estimated',
    ];

    public function customersys()
    {
        // 1:1
        return $this->hasOne(CustomerSys::class);
    }

    public function contractCus()
    {
        // N:1
        return $this->belongsTo(ContractCusService::class);
    }

    public function contractCusCycle()
    {
        // N:1
        return $this->belongsTo(ContractCusCycle::class);
    }

    public function contractPvd()
    {
        // N:1
        return $this->belongsTo(ContractPvdService::class);
    }

    public function orderItem()
    {
        // 1:N
        return $this->hasMany(OrderItem::class,'item_service_id','id');
    }

    public function PreResponse()
    {
        // 1:N
        return $this->hasMany(ServicePreResponse::class,'service_id','id');
    }

    public function Variations()
    {
        // 1:N
        return $this->hasMany(ServiceVariation::class,'service_id','id');
    }

    /* TYPE */
    public function type()
    {
        // 1:1
        return $this->hasOne(RefServiceType::class,'id','type_id');
    }

    public function category()
    {
        // 1:1
        return $this->hasOne(RefServiceCategory::class,'id','category_id');
    }

    // PROVIDERS QUE ATENDEM ESSE SERVIÇO
    public function providersContracts()
    {
        return $this->hasMany(ContractPvdService::class);
        // dd($this->);

    }

}
