<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ms_activitiesdescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ms_activities_id')->constrained();
            $table->foreignId('ms_languages_id')->constrained('ms_languages');
            $table->string('activity_name');
            $table->longText('sortdescription')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->uuid('uid')->default(DB::raw('(UUID())'));
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_activitiesdescriptions');
    }
};
