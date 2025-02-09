<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PopulationController;

Route::get('/', [PopulationController::class, 'index'])->name('population.index');
Route::get('/import', [PopulationController::class, 'importView'])->name('population.importView');
Route::post('/import', [PopulationController::class, 'import'])->name('population.import');
