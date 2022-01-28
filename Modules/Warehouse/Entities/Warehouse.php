<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\WarehouseFactory::new();
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
