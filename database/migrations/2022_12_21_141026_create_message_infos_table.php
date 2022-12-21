<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('message_id')->nullable();
            $table->bigInteger('recruiter_id')->nullable();
            $table->bigInteger('seeker_id')->nullable();
            $table->bigInteger('job_id')->nullable();
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
        Schema::dropIfExists('message_infos');
    }
};
