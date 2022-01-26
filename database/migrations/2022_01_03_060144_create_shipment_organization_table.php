<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentOrganizationTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('shipment_organization', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shipment_id'); 
            $table->unsignedInteger('organization_id');
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
        Schema::dropIfExists('shipment_organization');
    }
}
