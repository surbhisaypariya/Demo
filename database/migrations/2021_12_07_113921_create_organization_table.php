<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organization_name');
            $table->string('organization_initials');
            $table->string('organization_type');
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('post_code')->nullable();
            $table->string('country')->nullable();
            $table->string('primary_contact_name');
            $table->string('secondary_contact_name')->nullable();
            $table->string('primary_contact_email');
            $table->string('secondary_contact_email')->nullable();
            $table->bigInteger('primary_contact_phone');
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
        Schema::dropIfExists('organization');
    }
}
