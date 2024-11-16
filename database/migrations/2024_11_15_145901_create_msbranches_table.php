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
        Schema::create('msbranches', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->longText('address');
            $table->foreignId('ms_country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ms_state_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ms_city_id')->constrained()->cascadeOnDelete();
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msbranches');
    }
};
