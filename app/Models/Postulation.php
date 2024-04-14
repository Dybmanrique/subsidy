<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'advicer',
        'status',
        'student_id',
        'announcement_id',
    ];

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function requirements(){
        return $this->belongsToMany(Requirement::class)->withPivot('file');
    }
}
