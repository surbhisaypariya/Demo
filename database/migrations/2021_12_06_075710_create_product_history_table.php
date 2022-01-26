<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id');
            $table->string('product_code_old')->nullable();
            $table->string('product_code_new')->nullable();
            $table->string('manufacture_old')->nullable();
            $table->string('manufacture_new')->nullable();
            $table->string('brand_name_old')->nullable();
            $table->string('brand_name_new')->nullable();
            $table->string('generic_name_old')->nullable();
            $table->string('generic_name_new')->nullable();
            $table->string('formulation_old')->nullable();
            $table->string('formulation_new')->nullable();
            $table->string('unit_size_old')->nullable();
            $table->string('unit_size_new')->nullable();
            $table->string('unit_of_sale_old')->nullable();
            $table->string('unit_of_sale_new')->nullable();
            $table->string('units_per_case_old')->nullable();
            $table->string('units_per_case_new')->nullable();
            $table->string('label_language_old')->nullable();
            $table->string('label_language_new')->nullable();
            $table->string('cold_chain_old')->nullable();
            $table->string('cold_chain_new')->nullable();
            $table->string('controlled_drugs_old')->nullable();
            $table->string('controlled_drugs_new')->nullable();
            $table->string('serialized_stock_old')->nullable();
            $table->string('serialized_stock_new')->nullable();
            $table->string('dangerous_goods_old')->nullable();
            $table->string('dangerous_goods_new')->nullable();
            $table->string('comments_old')->nullable();
            $table->string('comments_new')->nullable();
            $table->string('status_old')->nullable();
            $table->string('status_new')->nullable();
            $table->string('categories_old')->nullable();
            $table->string('categories_new')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('product_history');
    }
}
