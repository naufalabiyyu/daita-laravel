<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id_product');  // Primary key pake increments daripada integer
            $table->string('name')->length(30);
            $table->string('slug')->length(40);
            $table->longText('description');
            $table->integer('stock')->length(8);
            $table->integer('prices')->length(8);
            $table->longText('how_to_use');
            $table->longText('ingredients');
            
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
