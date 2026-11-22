<?php

use App\Http\Controllers\DiagnosisController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DiagnosisController::class, 'index'])->name('diagnosis.index');
Route::post('/analyze', [DiagnosisController::class, 'analyze'])->name('diagnosis.analyze');