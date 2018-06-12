<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_containers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("type");
            $table->date("store_date");
            $table->integer("blood_request_id")->unsigned()->nullable();
            $table->integer("donation_id")->unsigned();
            $table->timestamps();

            $table->foreign("blood_request_id")->references("id")->on("blood_requests");
            $table->foreign("donation_id")->references("id")->on("donations");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_containers');
    }
}
