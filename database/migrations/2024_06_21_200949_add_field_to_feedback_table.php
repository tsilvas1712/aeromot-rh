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
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('execution_rating');
            $table->text('execution_obs')->nullable();
            $table->string('tec_know_rating');
            $table->text('tec_know_obs')->nullable();
            $table->string('behavioral_respect_rating');
            $table->string('behavioral_proactivity_rating');
            $table->string('behavioral_excellence_rating');
            $table->string('behavioral_innovation_rating');
            $table->string('behavioral_flexibility_rating');
            $table->string('behavioral_rules_rating');
            $table->text('behavioral_obs')->nullable();
            $table->string('organization_planning_rating');
            $table->string('organization_organization_rating');
            $table->string('organization_priority_rating');
            $table->string('organization_deadlines_rating');
            $table->text('organization_obs')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            //
        });
    }
};
