<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('admin.users.index');
    }

    public function data(){
        return User::where('is_admin',1)->get();
    }

    public function create(){
        return view('admin.users.create');
    }

    public function edit(User $user){
        return view('admin.users.edit', compact('user'));
    }

    public function destroy(Request $request)
    {
        try {
            if($request->id == auth()->user()->id){
                return response()->json([
                    'message' => 'No se puede eliminar',
                    'code' => '500'
                ]);
            }
            
            User::find($request->id)->delete();
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
