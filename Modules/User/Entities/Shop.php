<?php

namespace Modules\User\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\ShopFactory::new();
    }
}
