<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'max_megabytes'
    ];

    public function subsidies(){
        return $this->belongsToMany(Subsidy::class)->withPivot('is_required');
    }
}
