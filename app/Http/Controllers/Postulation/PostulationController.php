<?php

namespace App\Http\Controllers\Postulation;

use App\Http\Controllers\Controller;
use App\Models\Subsidy;
use Illuminate\Http\Request;

class PostulationController extends Controller
{
    public function index(){
        $subsidies = Subsidy::where('status','activo')->get();
        return view('postulations.index', compact('subsidies'));
    }
}
