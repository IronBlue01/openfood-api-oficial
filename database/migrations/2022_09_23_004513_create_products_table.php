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
            $table->id();
            $table->string('code',200);
            $table->string('barcode',200)->nullable(true);
            $table->enum('status',['imported','draft']);
            $table->string('url',200)->nullable(true);
            $table->timestamp('imported_t');
            $table->string('product_name',200)->nullable(true);
            $table->string('quantity',200)->nullable(true);
            $table->text('categories')->nullable(true);
            $table->string('packaging',200)->nullable(true);
            $table->string('brands',200)->nullable(true);
            $table->string('image_url',200)->nullable(true);
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
