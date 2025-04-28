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
            // Drop the foreign key constraint first
            $table->dropForeign(['assigned_to']);
        });
    }
    
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Re-add the foreign key constraint if rolling back
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
};
