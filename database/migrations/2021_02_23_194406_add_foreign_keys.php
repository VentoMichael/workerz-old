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
        Schema::table('users', function(Blueprint $table) {
            $table->foreignId("province_id")->nullable()->constrained('provinces');
            $table->foreignId("plan_user_id")->nullable()->constrained('plan_users');
            $table->foreignId("role_id")->nullable()->constrained('roles');
        });
        Schema::table('phones', function(Blueprint $table) {
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::table('websites', function(Blueprint $table) {
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::table('loves', function(Blueprint $table) {
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::table('announcements', function(Blueprint $table) {
            $table->foreignId("user_id")->constrained('users');
            $table->foreignId("category_id")->constrained('categories');
            $table->foreignId("province_id")->constrained('provinces');
            $table->foreignId("plan_announcement_id")->constrained('plan_announcements');
        });
        Schema::table('start_date_users', function(Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('start_date_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('start_date_id')
                ->references('id')
                ->on('start_dates');
        });
        Schema::table('category_user', function(Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
        Schema::table('announcement_category', function(Blueprint $table) {
            $table->bigInteger('announcement_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('announcement_id')
                ->references('id')
                ->on('announcements');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
        Schema::table('start_date_announcements', function(Blueprint $table) {
            $table->bigInteger('announcement_id')->unsigned();
            $table->bigInteger('start_date_id')->unsigned();
            $table->foreign('announcement_id')
                ->references('id')
                ->on('announcements');
            $table->foreign('start_date_id')
                ->references('id')
                ->on('start_dates');
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
