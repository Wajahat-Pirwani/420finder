<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->decimal('suggested_price', 18,2)->nullable();
            $table->string('image');
            $table->string('sku')->nullable();
            $table->integer('category_id');
            $table->string('subcategory_ids');
            $table->string('subcategory_names');
            $table->integer('strain_id');
            $table->integer('genetic_id');
            $table->string('thc_percentage')->nullable();
            $table->string('cbd_percentage')->nullable();
            $table->tinyInteger('is_featured');
            $table->string('status');
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
        Schema::dropIfExists('brand_products');
    }
}
