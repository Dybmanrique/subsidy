<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'budget',
        'adviser',
        'status',
        'uuid',
        'activity_id',
        'student_id',
        'announcement_id',
        'editable_up_to',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->editable_up_to = now()->addDay();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class)->withPivot('file');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function states()
    {
        return $this->belongsToMany(State::class)->withPivot(['created_at', 'description'])->withTimestamps();
    }
}
