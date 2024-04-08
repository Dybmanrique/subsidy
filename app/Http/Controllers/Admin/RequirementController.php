<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function index()
    {
        return view('admin.requirements.index');
    }

    public function data()
    {
        return Requirement::all();
    }
    public function create()
    {
        return view('admin.requirements.create');
    }
    public function edit(Requirement $requirement)
    {
        return view('admin.requirements.edit', compact('requirement'));
    }
    public function destroy(Request $request)
    {
        try {
            Requirement::find($request->id)->delete();
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
