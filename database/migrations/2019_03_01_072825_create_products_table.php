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
            $table->bigIncrements('id');
            $table->string('sku');
            $table->string('name');
            $table->string('description');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('products_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('unit_price');
            $table->timestamps();
            $table->softDeletes();
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
