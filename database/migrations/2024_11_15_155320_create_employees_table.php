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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('full_name');
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('ms_country_id')->nullable()->constrained();
            $table->foreignId('ms_state_id')->nullable()->constrained();
            $table->foreignId('ms_city_id')->nullable()->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('subdepartment_id')->constrained();
            $table->string('job_position')->nullable()->constrained();
            $table->foreignId('msbranch_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('msreligion_id',)->nullable()->constrained();
            $table->string('msmarital_id')->nullable()->constrained();
            $table->enum('gender',['male','female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_join')->nullable();
            $table->decimal('salary',10,2);
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_visible');
            $table->string('status');
            $table->uuid('idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
