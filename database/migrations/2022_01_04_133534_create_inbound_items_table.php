<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundItemsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('inbound_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipment_id');
            $table->integer('product_id')->nullable();
            $table->string('aisle')->nullable();
            $table->string('pallet_id');
            $table->string('location');
            $table->string('unit_value')->nullable();
            $table->string('donation_reference');
            $table->string('total_value')->nullable();
            $table->string('allocation');
            $table->string('number_of_unit');
            $table->string('total_no_treatment')->nullable();
            $table->string('batch');
            $table->integer('batch_extension')->nullable();
            $table->string('expiry_date');
            $table->integer('fmd');
            $table->integer('status');
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
        Schema::dropIfExists('inbound_items');
    }
}
