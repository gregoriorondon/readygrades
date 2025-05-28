<?php

use App\Http\Controllers\UniversityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UniversityController::class)->group( function (){
    Route::get('/', 'index');
    Route::get('/organigrama', 'organigrama');
    /* Route::get('/login-admin', 'admin'); */
    /* Route::get('/student', 'students'); */
    /* Route::post('/detalles-estudiante', 'studentspublicdetails'); */
    /* Route::get('/registro-profesor', 'teacheradd'); */
});
