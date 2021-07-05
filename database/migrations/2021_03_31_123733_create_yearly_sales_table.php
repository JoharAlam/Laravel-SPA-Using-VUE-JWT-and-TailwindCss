<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearlySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_sales', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->string('category');
            $table->string('quantity_sold');
            $table->string('year');
            $table->string('yearly_sale');
            $table->string('first_sale');
            $table->string('last_sale');
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
        Schema::dropIfExists('yearly_sales');
    }
}
