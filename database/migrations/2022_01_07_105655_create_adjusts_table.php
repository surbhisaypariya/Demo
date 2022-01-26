<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('adjusts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inbounceitem_id');
            $table->integer('math_icon')->nullable();
            $table->integer('units')->nullable();
            $table->string('reason')->nullable();
            $table->string('comments')->nullable();
            $table->string('total_unit')->nullable();
            $table->string('adjusted')->nullable();
            $table->string('available')->nullable();
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
        Schema::dropIfExists('adjusts');
    }
}
