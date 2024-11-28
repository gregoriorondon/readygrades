<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function(){
    return view('about');
});

Route::get('/estudent', function(){
    return view('estudiantes');
});

Route::get('/history', function(){
    return view('historia');
});

Route::get('/login2', function(){
    return view('login2');
});

Route::get('/mision', function(){
    return view('mision');
});

Route::get('/vision', function(){
    return view('vision');
});

Route::get('/organigrama', function(){
    return view('organigrama');
});

route::get('/map', function(){
    return view('map');
});

route::get('/administracion', function(){
    return view('admin');
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
