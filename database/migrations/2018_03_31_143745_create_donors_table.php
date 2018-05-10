<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('residence_address_id')->unsigned();
            $table->integer('current_address_id')->unsigned()->nullable();
            $table->enum('blood_type', ['0', 'A', 'B', 'AB'])->nullable();
            $table->enum('rh', ['+', '-'])->nullable();
            $table->string('phone_number');
            $table->integer('weight');
            $table->date('birth_date');
            $table->boolean('is_allowed')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('current_address_id')->references('id')->on('addresses');
            $table->foreign('residence_address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donors');
    }
}
