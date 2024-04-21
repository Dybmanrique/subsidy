<?php

use App\Http\Controllers\Postulation\PostulationController;
use Illuminate\Support\Facades\Route;

Route::get('/subvenciones', [PostulationController::class, 'index'])->middleware(['auth', 'verified'])->name('postulations.index');
Route::get('/mis-postulaciones', [PostulationController::class, 'my_postulations'])->middleware(['auth', 'verified'])->name('postulations.my_postulations');
Route::get('/mis-postulaciones/{postulation}/editar', [PostulationController::class, 'postulate'])->middleware(['auth', 'verified'])->name('postulations.postulate');
Route::get('/postulaciones/{postulation}/ver', [PostulationController::class, 'view_documents'])->name('postulations.view_documents');