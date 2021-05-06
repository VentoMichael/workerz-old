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
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('surname')->nullable();
            $table->string('postal_adress')->nullable();
            $table->string('website')->nullable();
            $table->string('job')->nullable();
            $table->string('pricemax')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->unsignedSmallInteger('number')->default('0');
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
