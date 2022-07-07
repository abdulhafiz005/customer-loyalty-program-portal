<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterceptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interceptions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vehicle_no');
            $table->string('contact_no');
            $table->string('location');
            $table->integer('agent');
            $table->string('cnic');
            $table->string('type');
            $table->string('interception_status');
            /*$table->integer('questions');*/
            $table->char('status', 2);
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
        Schema::dropIfExists('interception');
    }
}
