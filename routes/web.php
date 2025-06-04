<?php

use App\Http\Controllers\RegisteredAdminController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\UniversityController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/* route::get('/administracion', function(){ */
/*     return view('admin',[ */
/*         'user'=>User::all() */
/*     ]); */
/* }); */

Route::controller(UniversityController::class)->group( function (){
    Route::get('/login-admin', 'admin');
    Route::get('/student', 'students');
    Route::post('/detalles-estudiante', 'studentspublicdetails');
    Route::get('/registro-profesor', 'teacheradd');
});

Route::controller(RegisteredAdminController::class)->middleware(['auth', 'no-devolver', 'token'])->group( function(){
    Route::get('/carreras', 'courses');
    Route::get('/autocomplete', 'autocourses');
    Route::get('/autocomplete/nucleos', 'autonucleos');
    Route::get('/nueva-carrera', 'newcourses');
    Route::post('/carreras-add-post', 'carreraprocess');
    Route::get('/nucleos', 'nucleo');
    Route::post('/crear-nucleo', 'nucleoadd');
    Route::get('/tramos-y-trayectos', 'trayectosview');
    Route::post('/crear-trayecto-y-tramos', 'trayectosadd');
    Route::get('/nomina-profesores', 'profesornomina');
    Route::get('/registro-administrador', 'adminadd');
    Route::get('/estudiantes-panel-administrativo/{student}', 'studentsadmindetails');
    Route::get('/estudiantes-panel-administrativo', 'studentsadmin');
    Route::get('/administracion', 'admindashboard');
    Route::get('/registro', 'create');
    Route::post('/registro', 'store');
    Route::get('/registro-estudiante', 'studentadd');
    Route::post('/registro-estudiante', 'studentstore');
    Route::get('/config', 'config');
    Route::delete('/config/{id}', 'eliminarSesion')->name('auth.delete');
});

Route::get('/login', [SesionController::class, 'create'])->name('login');
Route::post('/login', [SesionController::class, 'store']);
Route::post('/logout', [SesionController::class, 'destroy']);
Route::get('/login-profesor', [SesionController::class, 'createteacher'])->name('login-profesor');

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
