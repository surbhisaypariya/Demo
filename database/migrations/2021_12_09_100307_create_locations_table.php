<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('location_code');
            $table->string('location_type');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->integer('post_code');
            $table->string('country');
            $table->bigInteger('general_inquiry_phone')->nullable();
            $table->string('general_inquiry_email')->nullable();
            $table->string('primary_contact_name')->nullable();
            $table->string('secondary_contact_name')->nullable();
            $table->string('primary_contact_email')->nullable();
            $table->string('secondary_contact_email')->nullable();
            $table->bigInteger('primary_contact_phone')->nullable();
            $table->bigInteger('secondary_contact_phone')->nullable();
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
        Schema::dropIfExists('locations');
    }
}
