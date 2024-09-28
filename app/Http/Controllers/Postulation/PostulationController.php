<?php

namespace App\Http\Controllers\Postulation;

use App\Http\Controllers\Controller;
use App\Models\Postulation;
use App\Models\Subsidy;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PostulationController extends Controller
{
    public function index()
    {
        return view('postulations.index');
    }

    public function my_postulations()
    {
        if(auth()->user()->is_admin){
            abort(403, 'Los administradores no pueden tener postulaciones.');
        }

        return view('postulations.my_postulations');
    }

    public function postulate(Postulation $postulation)
    {
        if ($postulation->editable_up_to < now() || $postulation->editable_up_to === null) {
            abort(403, 'El registro ya no es editable.');
        }

        if($postulation->student->user_id !== auth()->user()->id){
            abort(403, 'No permitido.');
        }

        return view('postulations.postulate', compact('postulation'));
    }

    public function view_documents(Postulation $postulation)
    {
        return view('postulations.view_documents', compact('postulation'));
    }
}
