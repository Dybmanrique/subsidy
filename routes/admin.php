<?php

use App\Http\Controllers\Admin\RequirementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard');

Route::get('/admin/requisitos', [RequirementController::class, 'index'])->name('admin.requirements.index');
Route::get('/admin/requisitos/data', [RequirementController::class, 'data'])->name('admin.requirements.data');
Route::get('/admin/requisitos/crear', [RequirementController::class, 'create'])->name('admin.requirements.create');
Route::get('/admin/requisitos/{requirement}/editar', [RequirementController::class, 'edit'])->name('admin.requirements.edit');
Route::post('/admin/requisitos/eliminar', [RequirementController::class, 'destroy'])->name('admin.requirements.destroy');