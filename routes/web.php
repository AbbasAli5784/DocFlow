<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/upload', [DocumentController::class, 'store'])->name('documents.store');
Route::get('/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
Route::delete('/delete/{id}', [DocumentController::class, 'delete'])->name('documents.delete');