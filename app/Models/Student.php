<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'condition',
        'dni',
        'phone',
        'condition',
        'school_id',
        'user_id',
    ];
}
