<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'departament',
        'document',
        'head',
        'function',
    ];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
