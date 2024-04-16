<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'subsidy_id'
    ];

    public function subsidy(){
        return $this->belongsTo(Subsidy::class);
    }

    public function postulations(){
        return $this->hasMany(Postulation::class);
    }
}
