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
        Schema::create('ms_activitiesimages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ms_activities_id')->constrained();
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('activities_images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_activitiesimages');
    }
};
