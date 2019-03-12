<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductsImages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->boolean('main_image');
            $table->string('product_image_url');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')
                ->references('id')
                ->on('Products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProductsImages');
    }
}
