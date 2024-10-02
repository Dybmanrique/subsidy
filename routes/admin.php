<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\PostulationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubsidyController;
use App\Http\Controllers\Admin\VicerrectorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard');

Route::get('/requisitos', [RequirementController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.requirements.index');
Route::get('/requisitos/data', [RequirementController::class, 'data'])->middleware(['auth', 'verified'])->name('admin.requirements.data');
Route::get('/requisitos/crear', [RequirementController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.requirements.create');
Route::get('/requisitos/{requirement}/editar', [RequirementController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.requirements.edit');
Route::post('/requisitos/eliminar', [RequirementController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.requirements.destroy');

Route::get('/subvenciones', [SubsidyController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.subsidies.index');
Route::get('/subvenciones/data', [SubsidyController::class, 'data'])->middleware(['auth', 'verified'])->name('admin.subsidies.data');
Route::get('/subvenciones/crear', [SubsidyController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.subsidies.create');
Route::get('/subvenciones/{subsidy}/editar', [SubsidyController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.subsidies.edit');
Route::post('/subvenciones/eliminar', [SubsidyController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.subsidies.destroy');

Route::get('/vicerrectores', [VicerrectorController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.vicerrectors.index');
Route::get('/vicerrectores/data', [VicerrectorController::class, 'data'])->middleware(['auth', 'verified'])->name('admin.vicerrectors.data');
Route::get('/vicerrectores/crear', [VicerrectorController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.vicerrectors.create');
Route::get('/vicerrectores/{vicerrector}/editar', [VicerrectorController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.vicerrectors.edit');
Route::post('/vicerrectores/eliminar', [VicerrectorController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.vicerrectors.destroy');

Route::get('/convocatorias', [AnnouncementController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.announcements.index');
Route::get('/convocatorias/data', [AnnouncementController::class, 'data'])->middleware(['auth', 'verified'])->name('admin.announcements.data');
Route::get('/convocatorias/crear', [AnnouncementController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.announcements.create');
Route::get('/convocatorias/{announcement}/editar', [AnnouncementController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.announcements.edit');
Route::post('/convocatorias/eliminar', [AnnouncementController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.announcements.destroy');

Route::get('/facultades', [FacultyController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.faculties.index');
Route::get('/facultades/data', [FacultyController::class, 'data'])->middleware(['auth', 'verified'])->name('admin.faculties.data');
Route::get('/facultades/crear', [FacultyController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.faculties.create');
Route::get('/facultades/{faculty}/editar', [FacultyController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.faculties.edit');
Route::post('/facultades/eliminar', [FacultyController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.faculties.destroy');

Route::get('/escuelas', [SchoolController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.schools.index');
Route::get('/escuelas/data', [SchoolController::class, 'data'])->middleware(['auth', 'verified'])->name('admin.schools.data');
Route::get('/escuelas/crear', [SchoolController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.schools.create');
Route::get('/escuelas/{school}/editar', [SchoolController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.schools.edit');
Route::post('/escuelas/eliminar', [SchoolController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.schools.destroy');

Route::get('/estudiantes', [StudentController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.students.index');
Route::get('/estudiantes/data', [StudentController::class, 'data'])->middleware(['auth', 'verified'])->name('admin.students.data');
Route::get('/estudiantes/crear', [StudentController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.students.create');
Route::get('/estudiantes/{student}/editar', [StudentController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.students.edit');
Route::post('/estudiantes/eliminar', [StudentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.students.destroy');

Route::get('/postulaciones-subvencion/{subsidy}/postulaciones', [PostulationController::class, 'all_index'])->middleware(['auth', 'verified'])->name('admin.postulations.all_index');
Route::get('/postulaciones-subvencion/{subsidy}/data', [PostulationController::class, 'all_data'])->middleware(['auth', 'verified'])->name('admin.postulations.all_data');
Route::get('/postulacion/{id}/ver', [PostulationController::class, 'view_postulation'])->middleware(['auth', 'verified'])->name('admin.postulations.view_postulation');
Route::get('/postulaciones-subvencion/{subsidy}/ultima-convocatoria', [PostulationController::class, 'last_index'])->middleware(['auth', 'verified'])->name('admin.postulations.last_index');
Route::get('/postulaciones-subvencion/{subsidy}/ultima-convocatoria/data', [PostulationController::class, 'last_data'])->middleware(['auth', 'verified'])->name('admin.postulations.last_data');

Route::get('/reportes', [ReportController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.reports.index');
Route::post('/reporte-general', [ReportController::class, 'general'])->middleware(['auth', 'verified'])->name('admin.reports.general');
Route::post('/reporte-historico', [ReportController::class, 'historical'])->middleware(['auth', 'verified'])->name('admin.reports.historical');