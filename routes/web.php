<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentSignController;
use App\Http\Controllers\PdfTestController;
Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/documents-sign/{id}', [DocumentSignController::class, 'sign'])->name('sign');
Route::get('/pdf-test', [PdfTestController::class, 'index'])->name('pdf-test');
