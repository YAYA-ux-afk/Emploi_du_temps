<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimetableLog extends Model
{
    protected $fillable = [
        'course_id',
        'action',
        'old_values',
        'new_values',
        'user_id',
        'reason'
    ];

    // C'EST CETTE PARTIE QUI CORRIGE L'ERREUR :
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];
}
