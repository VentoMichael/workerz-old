<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('start_dates', function(Blueprint $table) {
            $table->foreignId("announcement_id")->constrained('announcements');
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::table('locations', function(Blueprint $table) {
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::table('jobs', function(Blueprint $table) {
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::table('announcements', function(Blueprint $table) {
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('job_id')->unsigned();
            $table->foreign('location_id')
                ->references('id')
                ->on('locations');
            $table->foreign('job_id')
                ->references('id')
                ->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
