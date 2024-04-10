<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
        'vicerrector_id',
        'subsidy_id'
    ];

    public function vicerrector(){
        return $this->belongsTo(Vicerrector::class);
    }
    
    public function subsidy(){
        return $this->belongsTo(Subsidy::class);
    }
}
