<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $regulation_link = Setting::where('key', 'regulation_link')->first()->value;
        $cover_image = Setting::where('key', 'cover_image')->first()->value;
        $subsidy_link = Setting::where('key', 'subsidy_link')->first()->value;
        $unasam_link = Setting::where('key', 'unasam_link')->first()->value;
        $vicerrectorate_link = Setting::where('key', 'vicerrectorate_link')->first()->value;

        return view('welcome', compact(
            'regulation_link',
            'cover_image',
            'unasam_link',
            'vicerrectorate_link',
            'subsidy_link',
        ));
    }
}
