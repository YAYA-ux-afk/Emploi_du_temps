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
        Schema::create('timetable_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); 
            $table->string('action');               // 'modification', 'annulation', etc.
            $table->json('old_values')->nullable(); 
            $table->json('new_values')->nullable(); 
            $table->unsignedBigInteger('user_id');   
            $table->text('reason')->nullable();     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetable_logs');
    }
};