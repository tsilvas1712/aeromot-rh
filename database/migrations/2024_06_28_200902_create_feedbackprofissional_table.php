<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     *
     */
    public function up(): void
    {
        Schema::create('feedbackprofissional', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staf_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->string('office');
            $table->string('staffer');
            $table->integer('rating');
            $table->string('receptive_leader_obs');
            $table->integer('receptive_leader_rating');
            $table->string('receive_feedback_obs');
            $table->integer('receive_feedback_rating');
            $table->string('answers_questions_obs');
            $table->integer('answers_questions_rating');
            $table->string('comunication_obs');
            $table->integer('comunication_rating');
            $table->string('trust_obs');
            $table->integer('trust_rating');
            $table->string('team_development_obs');
            $table->integer('team_development_rating');
            $table->string('autonomy_obs');
            $table->integer('autonomy_rating');
            $table->string('healthy_relationship_obs');
            $table->integer('healthy_relationship_rating');
            $table->string('observations');
            $table->string('evolution_obs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbackprofissional');
    }
};
