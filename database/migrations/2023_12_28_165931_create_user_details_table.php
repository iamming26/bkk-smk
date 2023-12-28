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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('birth')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('foto')->nullable();
            $table->string('education')->nullable();
            $table->string('school')->nullable();
            $table->string('certificate')->nullable();
            $table->integer('instation_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
