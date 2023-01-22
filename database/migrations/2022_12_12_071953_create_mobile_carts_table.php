<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_carts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('product_id');
            $table->string('vendor_id');
            $table->string('name');
            $table->string('price');
            $table->string('quantity');
            $table->string('type')->nullable();
            $table->string('size')->nullable();
            $table->string('order_type')->nullable();
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
        Schema::dropIfExists('mobile_carts');
    }
}
