<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $sections = [
            ['name' => 'Super Deals'],
            ['name' => 'Trending Products'],
            ['name' => 'New Products'],
            ['name' => 'Hot Selling Categories'],
            ['name' => 'New Products'],
            ['name' => 'Print on Demand'],
            ['name' => 'Recommended Products'],
        ];
        \Modules\Product\Entities\Section::insert($sections);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
