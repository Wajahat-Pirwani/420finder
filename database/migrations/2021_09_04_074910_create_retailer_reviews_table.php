<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailerReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retailer_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('retailer_id');
            $table->integer('product_id');
            $table->text('description');
            $table->decimal('rating', 18,2);
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
        Schema::dropIfExists('retailer_reviews');
    }
}
