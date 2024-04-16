<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'adviser',
        'status',
        'uuid',
        'activity_id',
        'student_id',
        'announcement_id',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function requirements(){
        return $this->belongsToMany(Requirement::class)->withPivot('file');
    }

    public function activity(){
        return $this->belongsTo(Activity::class);
    }
}
