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
        Schema::create('jobcats', function (Blueprint $table) {
            $table->id('jobcat_id')->index();
            $table->string('jobcat_name')->unique();
            $table->string('jobcat_url')->unique();
            $table->longText('jobcat_description')->unique();
            $table->string('jobcat_img_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobcats');
    }
};
