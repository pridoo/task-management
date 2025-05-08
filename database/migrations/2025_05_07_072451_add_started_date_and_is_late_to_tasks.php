<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Add started_date column to track when a task is started
            $table->timestamp('started_date')->nullable(); // Nullable for tasks that haven’t started yet
    
            // Add is_late column to track if the task is completed late
            $table->boolean('is_late')->default(false); // Defaults to false, will be updated later if task is late
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
};
