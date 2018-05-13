<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->integer('thrombocyte_quantity')->nullable();
            $table->integer('plasma_quantity')->nullable();
            $table->integer('red_blood_cells_quantity')->nullable(); //only if we have request of red blood cells we need blood_type and rh
            $table->string('blood_type')->nullable();
            $table->string('rh')->nullable();
            $table->string('urgency_level');

            $table->foreign('address_id')->references('id')->on('addresses');
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
        Schema::dropIfExists('blood_requests');
    }
}
