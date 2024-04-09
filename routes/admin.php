<?php

use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\Admin\SubsidyController;
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
Route::get('/admin/subvenciones/{requirement}/editar', [SubsidyController::class, 'edit'])->name('admin.subsidies.edit');
Route::post('/admin/subvenciones/eliminar', [SubsidyController::class, 'destroy'])->name('admin.subsidies.destroy');