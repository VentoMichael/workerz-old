<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->decimal('oldprice')->nullable();
            $table->string('duration');
            $table->boolean('hight_visibility');
            $table->boolean('priority');
            $table->boolean('directly_visible');
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
        Schema::dropIfExists('plan_announcements');
    }
}
