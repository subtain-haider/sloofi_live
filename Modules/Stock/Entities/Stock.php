<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
class Stock extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(\App\Models\Warehouse::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    protected static function newFactory()
    {
        return \Modules\Stock\Database\factories\StockFactory::new();
    }
}
