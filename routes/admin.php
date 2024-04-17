<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\PostulationController;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubsidyController;
use App\Http\Controllers\Admin\VicerrectorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard');

Route::get('/requisitos', [RequirementController::class, 'index'])->name('admin.requirements.index');
Route::get('/requisitos/data', [RequirementController::class, 'data'])->name('admin.requirements.data');
Route::get('/requisitos/crear', [RequirementController::class, 'create'])->name('admin.requirements.create');
Route::get('/requisitos/{requirement}/editar', [RequirementController::class, 'edit'])->name('admin.requirements.edit');
Route::post('/requisitos/eliminar', [RequirementController::class, 'destroy'])->name('admin.requirements.destroy');

Route::get('/subvenciones', [SubsidyController::class, 'index'])->name('admin.subsidies.index');
Route::get('/subvenciones/data', [SubsidyController::class, 'data'])->name('admin.subsidies.data');
Route::get('/subvenciones/crear', [SubsidyController::class, 'create'])->name('admin.subsidies.create');
Route::get('/subvenciones/{subsidy}/editar', [SubsidyController::class, 'edit'])->name('admin.subsidies.edit');
Route::post('/subvenciones/eliminar', [SubsidyController::class, 'destroy'])->name('admin.subsidies.destroy');

Route::get('/vicerrectores', [VicerrectorController::class, 'index'])->name('admin.vicerrectors.index');
Route::get('/vicerrectores/data', [VicerrectorController::class, 'data'])->name('admin.vicerrectors.data');
Route::get('/vicerrectores/crear', [VicerrectorController::class, 'create'])->name('admin.vicerrectors.create');
Route::get('/vicerrectores/{vicerrector}/editar', [VicerrectorController::class, 'edit'])->name('admin.vicerrectors.edit');
Route::post('/vicerrectores/eliminar', [VicerrectorController::class, 'destroy'])->name('admin.vicerrectors.destroy');

Route::get('/convocatorias', [AnnouncementController::class, 'index'])->name('admin.announcements.index');
Route::get('/convocatorias/data', [AnnouncementController::class, 'data'])->name('admin.announcements.data');
Route::get('/convocatorias/crear', [AnnouncementController::class, 'create'])->name('admin.announcements.create');
Route::get('/convocatorias/{announcement}/editar', [AnnouncementController::class, 'edit'])->name('admin.announcements.edit');
Route::post('/convocatorias/eliminar', [AnnouncementController::class, 'destroy'])->name('admin.announcements.destroy');

Route::get('/facultades', [FacultyController::class, 'index'])->name('admin.faculties.index');
Route::get('/facultades/data', [FacultyController::class, 'data'])->name('admin.faculties.data');
Route::get('/facultades/crear', [FacultyController::class, 'create'])->name('admin.faculties.create');
Route::get('/facultades/{faculty}/editar', [FacultyController::class, 'edit'])->name('admin.faculties.edit');
Route::post('/facultades/eliminar', [FacultyController::class, 'destroy'])->name('admin.faculties.destroy');

Route::get('/escuelas', [SchoolController::class, 'index'])->name('admin.schools.index');
Route::get('/escuelas/data', [SchoolController::class, 'data'])->name('admin.schools.data');
Route::get('/escuelas/crear', [SchoolController::class, 'create'])->name('admin.schools.create');
Route::get('/escuelas/{school}/editar', [SchoolController::class, 'edit'])->name('admin.schools.edit');
Route::post('/escuelas/eliminar', [SchoolController::class, 'destroy'])->name('admin.schools.destroy');

Route::get('/estudiantes', [StudentController::class, 'index'])->name('admin.students.index');
Route::get('/estudiantes/data', [StudentController::class, 'data'])->name('admin.students.data');
Route::get('/estudiantes/crear', [StudentController::class, 'create'])->name('admin.students.create');
Route::get('/estudiantes/{student}/editar', [StudentController::class, 'edit'])->name('admin.students.edit');
Route::post('/estudiantes/eliminar', [StudentController::class, 'destroy'])->name('admin.students.destroy');

Route::get('/postulaciones-subvencion/{subsidy}/postulaciones', [PostulationController::class, 'all_index'])->name('admin.postulations.all_index');
Route::get('/postulaciones-subvencion/{subsidy}/data', [PostulationController::class, 'all_data'])->name('admin.postulations.all_data');