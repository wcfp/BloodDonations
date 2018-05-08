<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('donor_id');
            $table->dateTime('appointment_date');
            $table->integer('pulse')->nullable();
            $table->integer('blood_pressure_systolic')->nullable();
            $table->integer('blood_pressure_diastolic')->nullable();
            $table->boolean('consumed_fat')->nullable();
            $table->boolean('consumed_alcohol')->nullable();
            $table->boolean('has_smoked')->nullable();
            $table->integer('sleep_quality')->nullable();
            $table->string('status');
            $table->dateTime('status_date');
            $table->string('rejection_reason')->nullable();

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
        Schema::dropIfExists('donations');
    }
}
