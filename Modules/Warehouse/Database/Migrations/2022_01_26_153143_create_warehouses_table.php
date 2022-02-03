<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('city');
            $table->string('country');
            $table->integer('monthly');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        $warehouses = [
            ['name' => 'Asia warehouse', 'address' => 'random Address', 'city' => 'Beijing', 'country' => 'China', 'monthly' => 100],
            ['name' => 'Europe warehouse', 'address' => 'random Address', 'city' => 'England', 'country' => 'UK', 'monthly' => 200],
            ['name' => 'America warehouse', 'address' => 'random Address', 'city' => 'Canada', 'country' => 'America', 'monthly' => 200],
        ];
        \Modules\Warehouse\Entities\Warehouse::insert($warehouses);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
