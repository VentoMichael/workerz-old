<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('catchPhrase')->nullable();
            $table->string('slug')->unique();
            $table->text('picture')->nullable();
            $table->string('description',256);
            $table->string('job');
            $table->boolean('banned')->default(false);
            $table->bigInteger('pricemax')->nullable();
            $table->boolean('is_draft');
            $table->bigInteger('view_count')->default(0);
            $table->boolean('sending_time_expire')->default(false);
            $table->boolean('is_payed')->default(false);
            $table->dateTime('end_plan')->nullable();
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
        Schema::dropIfExists('announcements');
    }
}
