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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('priority');
            $table->string('status');
            $table->foreignId('assigned_to')->constrained('users');
            $table->foreignId('admin_id')->constrained('admins');
            $table->string('attachment')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
