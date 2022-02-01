<?php

namespace Modules\Woocommerce\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class WoocommerceProduct extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Woocommerce\Database\factories\WoocommerceProductFactory::new();
    }


    public function woocommerce()
    {
        return $this->belongsTo(\App\Models\Woocommerce::class);
    }
}
