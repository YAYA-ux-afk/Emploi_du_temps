<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // On autorise Laravel à remplir ces colonnes
    protected $fillable = ['name', 'room'];
}
