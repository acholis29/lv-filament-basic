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
        Schema::create('ms_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ms_suppliers_id')->constrained();
            $table->foreignId('msbranch_id')->constrained('msbranches');
            $table->foreignId('ms_activitiescategorys_id')->constrained('ms_activitiescategorys');
            $table->string('activity_name');
            $table->longText('description')->nullable();
            $table->time('pickup_time')->nullable();
            $table->time('drop_time')->nullable();
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
        Schema::dropIfExists('ms_activities');
    }
};
