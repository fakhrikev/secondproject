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
        Schema::create('Products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku');
            $table->string('name');
            $table->string('description');
            $table->integer('category_id')->unsigned();
            $table->string('unit_price');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')
                ->references('id')
                ->on('ProductsCategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Products');
    }
}
