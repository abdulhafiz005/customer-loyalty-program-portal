<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truckers', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('cnic')->unique();
            $table->string('truck_no');
            $table->string('member_id');
            $table->date('d_o_b');
            $table->string('b_city');
            $table->string('driving_exp');
            $table->string('profile_p');
            $table->string('comments');
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
        Schema::dropIfExists('trucker');
    }
}
