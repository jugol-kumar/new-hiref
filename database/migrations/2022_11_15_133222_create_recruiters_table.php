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
        Schema::create('recruiters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_sname')->nullable();
            $table->string('hot_industry')->nullable();
            $table->string('emp_size')->nullable();
            $table->string('company_address')->nullable();
            $table->string('designation')->nullable();

            $table->string('work_mail')->nullable();
            $table->timestamp('work_mail_verified_at')->nullable();
            $table->string('business_file')->nullable();

            $table->boolean('is_active')->default(1);
            $table->boolean('is_verified')->default(0);
            $table->enum('status', ['approved', 'unapproved', 'waiting', 'cancel']);
            $table->boolean('post_auto_approved')->default(1);
            $table->softDeletes();
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

        Schema::dropIfExists('recruiters');
    }
};
