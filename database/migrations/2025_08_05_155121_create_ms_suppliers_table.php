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
        Schema::create('ms_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->foreignId('ms_country_id')->nullable()->constrained();
            $table->foreignId('ms_state_id')->nullable()->constrained();
            $table->foreignId('ms_city_id')->nullable()->constrained();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('ms_suppliers');
    }
};
