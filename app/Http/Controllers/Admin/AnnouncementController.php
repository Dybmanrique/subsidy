<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('admin.announcements.index');
    }

    public function data()
    {
        return Announcement::select('id','name','start','end','vicerrector_id','subsidy_id')->with(['vicerrector:id,name,last_name','subsidy:id,name'])->get();
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function destroy(Request $request)
    {
        try {
            Announcement::find($request->id)->delete();
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
