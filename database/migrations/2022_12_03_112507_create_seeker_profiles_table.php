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
        Schema::create('seeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('types')->nullable();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->json('subcategories')->nullable();
            $table->foreignId('division_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->double('exp_min_sal')->nullable();
            $table->double('exp_max_sal')->nullable();
            $table->json('upozillas')->nullable();

            $table->date('declined_date')->nullable();
            $table->text('experience')->nullable();
            $table->string('is_experienced')->nullable();
            $table->string('gender')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('company_name')->nullable();
            $table->string('designation')->nullable();

            $table->bigInteger('education_id')->nullable();
            $table->bigInteger('education_label_id')->nullable();
            $table->date('uni_end_date')->nullable();
            $table->date('uni_start_date')->nullable();
            $table->string('university')->nullable();

            $table->string('resume')->nullable();
            $table->longText('skills')->nullable();

            $table->integer('view_jobs')->nullable()->default(0);

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
        Schema::dropIfExists('seeker_profiles');
    }
};
