<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Frontend\Entities\Order;
use Modules\Order\Entities\ExternalOrder;
use Modules\Product\Entities\Product;
use Modules\Shopify\Entities\Shopify;
use Modules\Stock\Entities\Stock;
use Modules\User\Entities\Deposit;
use Modules\User\Entities\Shop;
use Modules\Woocommerce\Entities\Woocommerce;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function shopify()
    {
        return $this->hasMany(Shopify::class);
    }
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function externalOrders()
    {
        return $this->hasMany(ExternalOrder::class);
    }
    public function woocommerce()
    {
        return $this->hasMany(Woocommerce::class);
    }
    public function shop()
    {
        return $this->hasOne(Shop::class);
    }
}
