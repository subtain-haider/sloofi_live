<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Frontend\Database\factories\OrderFactory::new();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baskets()
    {
        return $this->morphMany(Basket::class, 'basketable');
    }
}
