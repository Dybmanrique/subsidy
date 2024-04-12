<?php

use App\Http\Controllers\Postulation\PostulationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostulationController::class, 'index'])->middleware(['auth', 'verified'])->name('postulations.index');