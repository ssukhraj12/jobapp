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
        Schema::create('jobtypes', function (Blueprint $table) {
            $table->id('jobtype_id')->index();
            $table->string('jobtype_title')->unique();
            $table->string('jobtype_slug')->unique();
            $table->longText('jobtype_description')->nullable();
            $table->string('jobtype_img_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobtypes');
    }
};
