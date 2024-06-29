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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staf_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->string('office')->nullable();
            $table->text('folloup')->nullable();
            $table->text('positive_points')->nullable();
            $table->text('improve_points')->nullable();
            $table->text('expectations')->nullable();
            $table->boolean('staffer')->default(true);
            $table->text('observations')->nullable();
            $table->string('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
