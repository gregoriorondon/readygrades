<?php

use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

route::get('/administracion', function(){
    return view('admin');
});

Route::controller(UniversityController::class)->group( function (){
    Route::get('/', 'index');
    Route::get('/organigrama', 'organigrama');
    Route::get('/login-admin', 'admin');
    Route::get('/student', 'students');
});
/* Route::get('/soliresgis', function(){ */
/*     return view('soliresgis'); */
/* }); */

Route::get('/hello', function(){
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/register', function (){
        return view('register');
    })->name('register');
    Route::get('/add-student', function (){
        return view('add-student');
    })->name('add-student');
});
