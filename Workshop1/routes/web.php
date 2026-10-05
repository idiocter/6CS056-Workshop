<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/student', [StudentController::class, 'submitForm']);
Route::get('/student', [StudentController::class, 'showForm']);
