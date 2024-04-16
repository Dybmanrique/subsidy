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

    public function generate_solicitude(Postulation $postulation) {
        $url = route('postulations.view_documents', $postulation);
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($url));
        $data = [
            'postulation' => $postulation,
            'user' => auth()->user(),
            'qrcode' => $qrcode,
            'url' => $url
        ];
        $pdf = Pdf::loadView('postulations.solicitude', $data);
        return $pdf->stream();
        // return view('postulations.solicitude', $data);
    }
}
