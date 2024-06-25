<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'staf_id',
        'user_id',
        'office',
        'folloup',
        'positive_points',
        'improve_points',
        'expectations',
        'staffer',
        'observations',
        'rating',
        'execution_rating',
        'execution_obs',
        'tec_know_rating',
        'tec_know_obs',
        'behavioral_respect_rating',
        'behavioral_proactivity_rating',
        'behavioral_excellence_rating',
        'behavioral_innovation_rating',
        'behavioral_flexibility_rating',
        'behavioral_rules_rating',
        'behavioral_obs',
        'organization_planning_rating',
        'organization_organization_rating',
        'organization_priority_rating',   
        'organization_deadlines_rating',
        'organization_obs',
        'evolution_obs',
    ];

    public function staf()
    {
        return $this->belongsTo(Staff::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
