<?php
namespace App\Traits;

trait MoneyTrait
{
    public function setServiceNegotiatedPriceAttribute($value)
    {
        // 19,99 > 19.99 1.000,00 > 1000.00
        $this->attributes['service_negotiated_price'] = str_replace(['R$',','],['','.'],$value);
    }

    public function setServiceNegotiatedPriceOverAttribute($value)
    {
        // 19,99 > 19.99 1.000,00 > 1000.00
        $this->attributes['service_negotiated_price_over'] = str_replace(['R$',','],['','.'],$value);
    }

    public function setServicePriceAttribute($value)
    {
        // 19,99 > 19.99 1.000,00 > 1000.00
        $this->attributes['service_price'] = str_replace(['R$',','],['','.'],$value);
    }

    public function setServicePriceOverAttribute($value)
    {
        // 19,99 > 19.99 1.000,00 > 1000.00
        $this->attributes['service_price_over'] = str_replace(['R$',','],['','.'],$value);
    }

    public function setServicePvdPriceAttribute($value)
    {
        // 19,99 > 19.99 1.000,00 > 1000.00
        $this->attributes['service_pvd_price'] = str_replace(['R$',','],['','.'],$value);
    }

    public function setServicePvdPriceOverAttribute($value)
    {
        // 19,99 > 19.99 1.000,00 > 1000.00
        $this->attributes['service_pvd_price_over'] = str_replace(['R$',','],['','.'],$value);
    }
}
