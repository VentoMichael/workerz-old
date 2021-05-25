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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId("plan_user_id")->nullable()->constrained('plan_users');
            $table->foreignId("role_id")->nullable()->constrained('roles');
        });
        Schema::table('phones', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');;
        });

        Schema::table('websites', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');;
        });
        Schema::table('physical_adresses', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');
            $table->foreignId("province_id")->nullable()->constrained('provinces');
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');;
            $table->foreignId("province_id")->constrained('provinces');
            $table->foreignId("start_month_id")->constrained('start_months');
            $table->foreignId("plan_announcement_id")->nullable()->constrained('plan_announcements');
        });
        Schema::table('like_announcements', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');
            $table->foreignId("announcement_id")->constrained('announcements')->onDelete('cascade');
            $table->unique(['user_id', 'announcement_id']);

        });
        Schema::table('like_users', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'customer_id']);
        });

        Schema::table('start_date_user', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('start_date_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('start_date_id')
                ->references('id')
                ->on('start_dates')
                ->onDelete('cascade');
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->bigInteger('from_id')->unsigned();
            $table->bigInteger('to_id')->unsigned();
            $table->foreign('from_id','from')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('to_id','to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::table('province_user', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('province_id')->nullable()->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces');
        });


        Schema::table('category_user', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
        Schema::table('announcement_category', function (Blueprint $table) {
            $table->bigInteger('announcement_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('announcement_id')
                ->references('id')
                ->on('announcements')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
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
