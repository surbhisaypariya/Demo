<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundHistoryTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('inbound_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inbounditem_id');
            $table->string('old_aisle')->nullable();
            $table->string('new_aisle')->nullable();
            $table->string('old_pallet_id')->nullable();
            $table->string('new_pallet_id')->nullable();
            $table->string('old_unit_value')->nullable();
            $table->string('new_unit_value')->nullable();
            $table->string('old_expiry_date')->nullable();
            $table->string('new_expiry_date')->nullable();
            $table->string('old_donation_reference')->nullable();
            $table->string('new_donation_reference')->nullable();
            $table->string('old_allocation')->nullable();
            $table->string('new_allocation')->nullable();
            $table->string('old_number_of_unit')->nullable();
            $table->string('new_number_of_unit')->nullable();
            $table->string('old_total_no_treatment')->nullable();
            $table->string('new_total_no_treatment')->nullable();
            $table->string('old_batch')->nullable();
            $table->string('new_batch')->nullable();
            $table->integer('old_batch_extension')->nullable();
            $table->integer('new_batch_extension')->nullable();
            $table->integer('old_fmd')->nullable();
            $table->integer('new_fmd')->nullable();
            $table->string('old_total_value')->nullable();
            $table->string('new_total_value')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('inbound_history');
    }
}
