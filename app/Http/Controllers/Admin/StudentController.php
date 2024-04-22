<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.students.index');
    }

    public function data()
    {
        return Student::select('id', 'condition', 'dni', 'phone', 'school_id', 'user_id')
            ->with([
                'user:id,name,last_name,email',
                'school' => function ($query) {
                    $query->select(['id', 'name', 'faculty_id'])->with(['faculty:id,name']);
                }
            ])->get();
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function destroy(Request $request)
    {
        try {
            $student = Student::find($request->id);
            if ($student) {
                return response()->json([
                    'message' => 'Algo no salió bien',
                    'code' => '500'
                ]);
            }

            if ($student->postulations()->exists()) {
                return response()->json([
                    'message' => 'No se puede eliminar porque tiene relaciones existentes',
                    'code' => '500'
                ]);
            }

            User::find($student->user_id)->delete();
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
