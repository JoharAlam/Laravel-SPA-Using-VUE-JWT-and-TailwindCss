<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->string('category');
            $table->string('total');
            $table->string('available');
            $table->string('returned')->nullable()->default(0);
            $table->string('price');
            $table->string('earned')->nullable()->default(0);
            $table->string('profit')->nullable()->default(0);
            $table->string('loss')->nullable()->default(0);
            $table->string('status')->nullable()->default('In Stock');
            $table->string('first_purchase');
            $table->string('purchase_updated');
            $table->string('retailer_id');
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
        Schema::dropIfExists('stocks');
    }
}
