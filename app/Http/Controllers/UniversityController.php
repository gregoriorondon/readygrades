<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(){
        return view('home');
    }
    public function organigrama(){
        return view('organigrama');
    }
    public function students(){
        return view('estudiantes');
    }
    public function admin(){
        return view ('auth.login');
    }
    public function studentadd(){
        return view('auth.registro-estudiante');
    }
    public function courses(){
        return view('auth.courses');
    }
    public function studentsadmin(){
        return view('auth.students');
    }
    public function teacheradd(){
        return view('auth.registro-profesor');
    }
    public function adminadd(){
        return view('auth.registro-admin');
    }
    public function profesornomina(){
        return view('auth.profesores-nomina');
    }
}
