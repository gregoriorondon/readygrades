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

Route::get('/login', function(){
    return view('login');
});

Route::get('/mision', function(){
    return view('mision');
});

Route::get('/vision', function(){
    return view('vision');
});

Route::get('/map', function(){
    return view('map');
});

