<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('donation_id');
            $table->string('product_code')->nullable();
            $table->string('manufecturer')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('generic_name')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('unit_offered')->nullable();
            $table->string('pack_size')->nullable();
            $table->string('unit_pallet')->nullable();
            $table->string('pattle_guesstimate')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('udi')->nullable();
            $table->string('location')->nullable();
            $table->string('lable_language')->nullable();
            $table->string('specific_appeal')->nullable();
            $table->integer('pom')->nullable();
            $table->integer('cold_chain')->nullable();
            $table->integer('controlled_drugs')->nullable();
            $table->integer('serialize_stock')->nullable();
            $table->integer('dangerous_drugs')->nullable();
            $table->string('storage_req')->nullable();
            $table->integer('supplies')->nullable();
            $table->string('formulation')->nullable();
            $table->integer('unit_size')->nullable();
            $table->string('unit_of_sale')->nullable();
            $table->string('unit_per_case')->nullable();
            $table->string('supplier_price_unit')->nullable();
            $table->string('internal_price_unit')->nullable();
            $table->string('reporting_req')->nullable();
            $table->string('intended_market')->nullable();
            $table->string('product_licence')->nullable();
            $table->string('information')->nullable();
            $table->string('comments')->nullable();
            $table->integer('status');
            $table->integer('commit_status');
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
        Schema::dropIfExists('donation_items');
    }
}
