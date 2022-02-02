<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Category\Entities\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('parent_category')->nullable();
            $table->integer('order_level')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
//            $table->string('otp_id')->nullable();
//            $table->string('price_increment_type')->nullable();
//            $table->float('price_1')->nullable();
//            $table->float('price_500')->nullable();
//            $table->float('price_1000')->nullable();
//            $table->float('shipping_cost_1')->nullable();
//            $table->float('shipping_cost_500')->nullable();
//            $table->float('shipping_cost_1000')->nullable();
            $table->timestamps();
        });
        $categories = [
            ['name' => 'Computer & Office'],
            ['name' => 'Bags & Shoes'],
            ['name' => 'Jewelry & Watches'],
            ['name' => 'Health, Beauty & Hair'],
            ['name' => 'Women Clothing'],
            ['name' => 'Sports & Outdoors'],
            ['name' => 'Home, Garden & Furniture'],
            ['name' => 'Home Improvement'],
            ['name' => 'Automobiles & Motorcycles'],
            ['name' => 'Toys, Kids & Babies'],
            ['name' => 'Men Clothing'],
            ['name' => 'Consumer Electronics'],
            ['name' => 'Phones & Accessories'],
        ];
        Category::insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
