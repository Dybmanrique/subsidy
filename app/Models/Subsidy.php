<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsidy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function requirements(){
        return $this->belongsToMany(Requirement::class)->withPivot('is_required');
    }

    public function announcement(){
        return $this->hasMany(Announcement::class);
    }

    public function activities(){
        return $this->hasMany(Activity::class);
    }
}
