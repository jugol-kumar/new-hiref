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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('types');
            $table->string('label');
            $table->integer('category_id')->unsigned();
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->integer('child_category_id')->unsigned()->nullable();
            $table->json('tags');
            $table->json('skills');
            $table->integer('currency')->unsigned();
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('min_experience')->default(0);
            $table->integer('max_experience');
            $table->enum('experience_type', ['year', 'month', 'days'])->default('year');
            $table->enum('lived', ['lived', 'cancel', 'draft', 'pending', 'deleted']);
            $table->integer('show_count')->default(0);
            $table->integer('company')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('creator')->unsigned();
            $table->date('declined_date');
            $table->string('web_address');
            $table->string('location');
            $table->boolean('is_remote');
            $table->boolean('fultime_remote');
            $table->boolean('is_published')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->longText('job_details');
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
        Schema::dropIfExists('jobs');
    }
};
