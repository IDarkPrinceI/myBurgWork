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
            $table->increments('id');
            $table->string('title')->unique();
            $table->integer('category_id')->unsigned();
            $table->string('slug')->unique();
            $table->integer('price')->unsigned();
            $table->text('description');
            $table->integer('old_price')->nullable()->unsigned();
            $table->boolean('is_new')->default(0);
            $table->boolean('is_hit')->default(0);
            $table->string('content')->nullable();
            $table->string('keywords')->nullable();
            $table->string('img')->default('no-img.png');
            $table->integer('view')->unsigned()->default(0);
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
