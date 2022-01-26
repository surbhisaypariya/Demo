<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code');
            $table->string('manufacture');
            $table->string('brand_name');
            $table->string('generic_name');
            $table->string('formulation');
            $table->string('description')->nullable();
            $table->integer('unit_size');
            $table->string('unit_of_sale');
            $table->string('treatment')->nullable();
            $table->integer('units_per_case');
            $table->string('label_language');
            $table->string('limits')->nullable();
            $table->string('original_approved')->nullable();
            $table->string('standard_cost')->nullable();
            $table->string('tax_val')->nullable();
            $table->string('product_licence')->nullable();
            $table->string('hs_code')->nullable();
            $table->string('intended_market')->nullable();
            $table->string('extended_cost')->nullable();
            $table->string('fair_market_val')->nullable();
            $table->string('country_manufecture')->nullable();
            $table->string('storage_req');
            $table->string('cold_chain');
            $table->string('controlled_drugs');
            $table->string('serialized_stock');
            $table->string('dangerous_goods');
            $table->string('comments')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('products');
    }
}
