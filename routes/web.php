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

route::get('/map', function(){
    return view('map');
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
});
