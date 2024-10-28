<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id')->index();
            $table->foreignId('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('jobcat_id')->unsigned()->index();
            $table->foreign('jobcat_id')->references('jobcat_id')->on('jobcats')->onDelete('cascade');
            $table->foreignId('jobtype_id')->unsigned()->index();
            $table->foreign('jobtype_id')->references('jobtype_id')->on('jobtypes')->onDelete('cascade');
            $table->foreignId('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('job_title');
            $table->longText('job_description');
            $table->float('salary_from');
            $table->bigInteger('salary_to')->nullable();
            $table->integer('salary_type')->default(0);
            $table->integer('job_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
