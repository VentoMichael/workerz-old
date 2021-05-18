<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('picture')->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique()->nullable();
            $table->string('surname')->nullable();
            $table->string('website')->nullable();
            $table->string('job')->nullable();
            $table->string('pricemax')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->text('description')->nullable();
            $table->boolean('sending_time_expire')->default(false);
            $table->dateTime('end_plan')->nullable();
            $table->boolean('is_payed')->default(false);
            $table->boolean('banned')->default(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        }  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
