<?php

namespace App\Model;

use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Model;

class RefServiceCategory extends Model
{
    use SlugTrait;

    protected $table = 'ref_service_category';

    protected $fillable = ['service_type_id','ref_description','ref_placeholder'];

    public function customersys()
    {
        // 1:1
        return $this->hasOne(CustomerSys::class);
    }

    public function type()
    {
        // 1:1
        return $this->hasOne(RefServiceType::class,'id','service_type_id');
    }
}
