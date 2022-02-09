<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Deposit extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\DepositFactory::new();
    }
}
