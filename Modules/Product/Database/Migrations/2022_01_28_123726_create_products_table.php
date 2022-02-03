<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tags')->nullable();
            $table->string('description')->nullable();
            $table->integer('purchase_price')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
            //create table
//            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            //properties
//            $table->integer('featured')->nullable();
//            $table->integer('published')->nullable();
//            $table->integer('min_qty')->default(0)-;
            //do nothing for shipping now
//            $table->string('shipping_type')->default('free');
//            $table->integer('shipping_days')->nullable();
//            $table->integer('sales')->default(0);
//            $table->float('shipping_1')->nullable();
//            $table->float('shipping_100')->nullable();
//            $table->float('shipping_1000')->nullable();
//            $table->integer('rating')->nullable();
                //create table
//            $table->float('price_1')->nullable();
//            $table->float('price_100')->nullable();
//            $table->float('price_1000')->nullable();
//table create
//            $table->integer('discount')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
