<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait SlugTrait
{
    public function setCusNameAttribute($value)
    {
        $slug = Str::slug($value);

        // GARANTIR QUE NAO EXISTE DUPLICIDADE
        //$matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count(); // MYSQL 'REGEXP'

        //
        if(!empty($this->attributes['cus_slug']) && $this->attributes['cus_slug'] == $slug)
            $matchs = $this->whereRaw("cus_slug ~ '^{$slug}(-[0-9]*)?$'")->where('id','<>',$this->attributes['id'])->count();    // POSTGRESS '~'
        else
            $matchs = $this->whereRaw("cus_slug ~ '^{$slug}(-[0-9]*)?$'")->count();    // POSTGRESS '~'

        //dd($this->attributes, $value, $slug, $matchs);

        $this->attributes['cus_name'] = $value;
        $this->attributes['cus_slug'] = $matchs ?  $slug.'-'.$matchs : $slug;
    }

    public function setServiceNameAttribute($value)
    {
        $slug = Str::slug($value);

        // GARANTIR QUE NAO EXISTE DUPLICIDADE
        //$matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count(); // MYSQL 'REGEXP'

        //
        if(!empty($this->attributes['service_slug']) && $this->attributes['service_slug'] == $slug)
            $matchs = $this->whereRaw("service_slug ~ '^{$slug}(-[0-9]*)?$'")->where('id','<>',$this->attributes['id'])->count();    // POSTGRESS '~'
        else
            $matchs = $this->whereRaw("service_slug ~ '^{$slug}(-[0-9]*)?$'")->count();    // POSTGRESS '~'

        //dd($this->attributes, $value, $slug, $matchs);

        $this->attributes['service_name'] = $value;
        $this->attributes['service_slug'] = $matchs ?  $slug.'-'.$matchs : $slug;
    }

    public function setPvdSlugAttribute($value)
    {
        $slug = Str::slug($value);

        //
        if(!empty($this->attributes['pvd_slug']) && $this->attributes['pvd_slug'] == $slug)
            $matchs = $this->whereRaw("pvd_slug ~ '^{$slug}(-[0-9]*)?$'")->where('id','<>',$this->attributes['id'])->count();    // POSTGRESS '~'
        else
            $matchs = $this->whereRaw("pvd_slug ~ '^{$slug}(-[0-9]*)?$'")->count();    // POSTGRESS '~'

        $this->attributes['pvd_slug'] = $matchs ?  $slug.'-'.$matchs : $slug;
    }

    public function setRefDescriptionAttribute($value)
    {
        $this->attributes['ref_description'] = $value;
        $this->attributes['ref_slug'] = Str::slug($value);
    }
}
