<?php

namespace App\Model;

use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Model;

class RefProviderSpecialty extends Model
{
    use SlugTrait;

    protected $table = 'ref_provider_specialty';

    protected $fillable = ['ref_description','ref_placeholder'];

    public function customersys()
    {
        // 1:1
        return $this->hasOne(CustomerSys::class);
    }
}
