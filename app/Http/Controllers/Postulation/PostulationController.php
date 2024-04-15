<?php

namespace App\Http\Controllers\Postulation;

use App\Http\Controllers\Controller;
use App\Models\Postulation;
use App\Models\Subsidy;
use Illuminate\Http\Request;

class PostulationController extends Controller
{
    public function index(){
        $subsidies = Subsidy::where('status','activo')->get();
        return view('postulations.index', compact('subsidies'));
    }

    public function my_postulations(){
        return view('postulations.my_postulations');
    }

    public function postulate(Postulation $postulation) {
        return view('postulations.postulate', compact('postulation'));
    }

    public function view_documents(Postulation $postulation) {
        return view('postulations.view_documents', compact('postulation'));
    }
}
