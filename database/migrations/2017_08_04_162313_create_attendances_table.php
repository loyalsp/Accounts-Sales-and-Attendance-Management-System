<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateAttendancesTable extends Migration
{
    private function getToday()
    {
        $today = new DateTime('Asia/Karachi');
        return $today->format('D M j');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('store_id')->unsigned()->nullable();
            //$table->string('current_month');
            $table->string('current_date');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('leave_type')->nullable();
            $table->double('working_hours',4,2)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('store_id')->references('id')->on('stores');
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
        Schema::dropIfExists('attendances');
    }
}