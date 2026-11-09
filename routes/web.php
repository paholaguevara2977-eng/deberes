<?php

use App\Http\Controllers\DeberController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DeberController::class, 'dashboard'])->name('dashboard');

Route::get('deberes/{deber}/descargar', [DeberController::class, 'download'])
    ->name('deberes.download');

Route::get('deberes/{deber}/ver', [DeberController::class, 'preview'])
    ->name('deberes.preview');

Route::resource('deberes', DeberController::class)
    ->parameters(['deberes' => 'deber'])
    ->only(['index', 'create', 'store', 'show', 'destroy']);
