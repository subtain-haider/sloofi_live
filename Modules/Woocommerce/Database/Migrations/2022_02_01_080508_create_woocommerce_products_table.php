<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWoocommerceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('woocommerce_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('woocommerce_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->string('product_type');
            $table->string('status');
            $table->string('tags');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('woocommerce_products');
    }
}
