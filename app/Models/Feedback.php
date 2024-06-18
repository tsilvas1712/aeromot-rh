<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

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
