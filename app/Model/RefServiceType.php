<?php

namespace App\Model;

use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Model;

class RefServiceType extends Model
{
    use SlugTrait;

    protected $table = 'ref_service_type';

    protected $fillable = ['ref_description','ref_placeholder'];

    public function customersys()
    {
        // 1:1
        return $this->hasOne(CustomerSys::class);
    }

    public function category()
    {
        // 1:1
        return $this->hasOne(RefServiceCategory::class,'service_type_id','id');
    }
}
