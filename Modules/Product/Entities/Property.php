<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Property extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\PropertyFactory::new();
    }
}
