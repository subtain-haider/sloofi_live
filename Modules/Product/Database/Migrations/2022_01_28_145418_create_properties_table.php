<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
//        $properties = [
//            ['name' => 'Super Deals'],
//            ['name' => 'Trending Products'],
//            ['name' => 'New Products'],
//            ['name' => 'Hot Selling Categories'],
//            ['name' => 'New Products'],
//            ['name' => 'Print on Demand'],
//            ['name' => 'Recommended Products'],
//        ];
//        \Modules\Product\Entities\Property::insert($properties);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
