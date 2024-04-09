<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsidy;
use Illuminate\Http\Request;

class SubsidyController extends Controller
{

    public function index()
    {
        return view('admin.subsidies.index');
    }

    public function data()
    {
        return Subsidy::all();
    }

    public function create()
    {
        return view('admin.subsidies.create');
    }

    public function edit(Subsidy $subsidy)
    {
        return view('admin.subsidies.edit', compact('subsidy'));
    }

    public function destroy(Request $request)
    {
        try {
            Subsidy::find($request->id)->delete();
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
