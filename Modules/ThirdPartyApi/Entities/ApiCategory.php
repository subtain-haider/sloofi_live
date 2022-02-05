<?php

namespace Modules\ThirdPartyApi\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;

class ApiCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function newFactory()
    {
        return \Modules\ThirdPartyApi\Database\factories\ApiCategoryFactory::new();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
