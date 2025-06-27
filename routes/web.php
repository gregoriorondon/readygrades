<?php

use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\RegisteredAdminController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

Route::controller(UniversityController::class)->group( function (){
    Route::get('/login-admin', 'admin');
    Route::get('/student', 'students');
    Route::post('/detalles-estudiante', 'studentspublicdetails');
});

Route::controller(RegisteredAdminController::class)->middleware(['auth:admins,root', 'no-devolver', 'token'])->group( function(){
    // Carreras
    Route::get('/carreras', 'courses');
    Route::get('/autocomplete', 'autocourses');
    Route::post('/carreras-add-post', 'carreraprocess');
    Route::get('/edit-courses/{carrera}', 'carreraedit');
    Route::post('/savecarrera/{carrera}', 'cambiarcarrera');
    // Nucleos
    Route::get('/autocomplete/nucleos', 'autonucleos');
    Route::get('/nucleos', 'nucleo');
    Route::get('/edit-nucleo/{nucleo}', 'nucleoedit');
    Route::post('/save-nucleo/{nucleo}', 'editnucleosave');
    Route::post('/crear-nucleo', 'nucleoadd');
    // Tramos-Trayectos
    Route::get('/tramos-y-trayectos', 'trayectosview');
    Route::post('/crear-trayecto-y-tramos', 'trayectosadd');
    //
    Route::get('/nomina-profesores', 'profesornomina');
    Route::get('/registro-profesor', 'teacheradd');
    Route::post('/registro-profesor', 'teacherstore')->name('registro.profesor');
    Route::get('/docentes-panel-administrativo/{docentes}', 'teacherinfo');
    Route::get('/registro-administrador', 'adminadd');
    Route::get('/estudiantes-panel-administrativo/{student}', 'studentsadmindetails');
    Route::get('/estudiantes-panel-administrativo', 'studentsadmin');
    Route::get('/administracion', 'admindashboard');
    Route::get('/registro', 'create');
    Route::post('/registro', 'store');
    Route::get('/nomina-administradores', 'admininfo');
    Route::get('/administrador-panel-administrativo/{administrador}', 'admindetails');
    Route::get('/registro-estudiante', 'studentadd');
    Route::post('/registro-estudiante', 'studentstore');
    Route::get('/generar-documentos', 'generar');
    Route::post('/generarpdf', 'generarprocess')->name('generarpdf');
    Route::get('/generarpdf', 'generarrecarga')->name('generarpdf');
    //Cargo
    Route::get('/agregar-cargo', 'cargoadd')->name('cargo.index');
    Route::post('/agregar-create', 'cargosave')->name('crearcargo');
    //config
    Route::get('/config', 'config');
    Route::delete('/config/{id}', 'eliminarSesion')->name('auth.delete');
    //Materias
    Route::get('/materias', 'materias');
    Route::get('/editar-materia/{materia}', 'materiaedit');
    Route::post('/save-edit/{materia}', 'cambiaredit');
    Route::post('/materia', 'materiasadd');
    //Pensum
    Route::get('/pensum', 'pensum');
    Route::get('/pensum-add', 'pensumadd');
    Route::post('/pensums', 'pensumstore');
    Route::get('/autocomplete/pensum', 'searchpensum');
    // Seccion:
    Route::post('/seccionadd', 'seccionadd');
});

Route::get('/login', [SesionController::class, 'create'])->name('login');
Route::post('/login', [SesionController::class, 'store']);
Route::post('/logout', [SesionController::class, 'destroy']);
Route::get('/login-profesor', [SesionController::class, 'createteacher'])->name('login-profesor');
// Route::post('/login', [SesionController::class, 'store']);

Route::controller(ProfesorController::class)->middleware(['auth:teachers'])->group( function(){
    Route::get('/dashboard', 'board');
});
