<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\SubsidyController;
use App\Http\Controllers\Admin\VicerrectorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard');

Route::get('/admin/requisitos', [RequirementController::class, 'index'])->name('admin.requirements.index');
Route::get('/admin/requisitos/data', [RequirementController::class, 'data'])->name('admin.requirements.data');
Route::get('/admin/requisitos/crear', [RequirementController::class, 'create'])->name('admin.requirements.create');
Route::get('/admin/requisitos/{requirement}/editar', [RequirementController::class, 'edit'])->name('admin.requirements.edit');
Route::post('/admin/requisitos/eliminar', [RequirementController::class, 'destroy'])->name('admin.requirements.destroy');

Route::get('/admin/subvenciones', [SubsidyController::class, 'index'])->name('admin.subsidies.index');
Route::get('/admin/subvenciones/data', [SubsidyController::class, 'data'])->name('admin.subsidies.data');
Route::get('/admin/subvenciones/crear', [SubsidyController::class, 'create'])->name('admin.subsidies.create');
Route::get('/admin/subvenciones/{subsidy}/editar', [SubsidyController::class, 'edit'])->name('admin.subsidies.edit');
Route::post('/admin/subvenciones/eliminar', [SubsidyController::class, 'destroy'])->name('admin.subsidies.destroy');

Route::get('/admin/vicerrectores', [VicerrectorController::class, 'index'])->name('admin.vicerrectors.index');
Route::get('/admin/vicerrectores/data', [VicerrectorController::class, 'data'])->name('admin.vicerrectors.data');
Route::get('/admin/vicerrectores/crear', [VicerrectorController::class, 'create'])->name('admin.vicerrectors.create');
Route::get('/admin/vicerrectores/{vicerrector}/editar', [VicerrectorController::class, 'edit'])->name('admin.vicerrectors.edit');
Route::post('/admin/vicerrectores/eliminar', [VicerrectorController::class, 'destroy'])->name('admin.vicerrectors.destroy');

Route::get('/admin/convocatorias', [AnnouncementController::class, 'index'])->name('admin.announcements.index');
Route::get('/admin/convocatorias/data', [AnnouncementController::class, 'data'])->name('admin.announcements.data');
Route::get('/admin/convocatorias/crear', [AnnouncementController::class, 'create'])->name('admin.announcements.create');
Route::get('/admin/convocatorias/{announcement}/editar', [AnnouncementController::class, 'edit'])->name('admin.announcements.edit');
Route::post('/admin/convocatorias/eliminar', [AnnouncementController::class, 'destroy'])->name('admin.announcements.destroy');

Route::get('/admin/facultades', [FacultyController::class, 'index'])->name('admin.faculties.index');
Route::get('/admin/facultades/data', [FacultyController::class, 'data'])->name('admin.faculties.data');
Route::get('/admin/facultades/crear', [FacultyController::class, 'create'])->name('admin.faculties.create');
Route::get('/admin/facultades/{faculty}/editar', [FacultyController::class, 'edit'])->name('admin.faculties.edit');
Route::post('/admin/facultades/eliminar', [FacultyController::class, 'destroy'])->name('admin.faculties.destroy');

Route::get('/admin/escuelas', [SchoolController::class, 'index'])->name('admin.schools.index');
Route::get('/admin/escuelas/data', [SchoolController::class, 'data'])->name('admin.schools.data');
Route::get('/admin/escuelas/crear', [SchoolController::class, 'create'])->name('admin.schools.create');
Route::get('/admin/escuelas/{school}/editar', [SchoolController::class, 'edit'])->name('admin.schools.edit');
Route::post('/admin/escuelas/eliminar', [SchoolController::class, 'destroy'])->name('admin.schools.destroy');