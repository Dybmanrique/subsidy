<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vicerrector;
use Illuminate\Http\Request;

class VicerrectorController extends Controller
{
    public function index()
    {
        return view('admin.vicerrectors.index');
    }

    public function data()
    {
        return Vicerrector::all();
    }

    public function create()
    {
        return view('admin.vicerrectors.create');
    }

    public function edit(Vicerrector $vicerrector)
    {
        return view('admin.vicerrectors.edit', compact('vicerrector'));
    }

    public function destroy(Request $request)
    {
        try {
            Vicerrector::find($request->id)->delete();
            return response()->json([
                'message' => 'Eliminado correctamente',
                'code' => '200'
            ]);   
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'No se puede eliminar',
                'code' => '500'
            ]);
        }
    }
}
