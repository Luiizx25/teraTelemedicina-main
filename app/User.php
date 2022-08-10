<?php

namespace App;

use App\Model\Customer;
use App\Model\CustomerSys;
use App\Model\Provider;
use App\Traits\UserTrait;
use App\Notifications\EnvioEmailResetPasswordMsg;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use UserTrait;

    protected $table = 'users';

    protected $dates = ['date_birth'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'date_birth',
        'phone_mobile',
        'phone',
        'photo',
        'admin_system',
        'admin_syscustomer',
        'admin_customer',
        'admin_provider',
        'admin_patient',
        'admin_financial',
        'admin_billing',
        'validity_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /* RELATIONS */

    public function customersys()
    {
        // N:N
        return $this->belongsToMany(CustomerSys::class,'tb_customersys_users','user_id','customer_sys_id');
    }

    public function customer()
    {
        // N:N
        return $this->belongsToMany(Customer::class,'tb_customers_users','user_id','customer_id')->withPivot('financial','tecnical','manager');
    }

    public function provider()
    {
        // 1:1
        return $this->hasOne(Provider::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EnvioEmailResetPasswordMsg($token));
    }




    /*

    // 1:1
    return $this->hasOne(Store::class);

    // 1:N
    return $this->hasMany(ProductImage::class);

    // N:1
    return $this->belongsTo(Store::class);

    // N:N
    return $this->belongsToMany(Product::class,'tb_category_product');


    */


}
