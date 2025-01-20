<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function courses(){
        return view('auth.courses');
    }
    public function studentsadmin(){
        $students = Students::paginate(20);
        return view('auth.students', ['estudiantes' => $students]);
    }
    public function studentsadmindetails(Students $student){
        return view('auth.students-details', ['estudiantes' => $student]);
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
    public function admindashboard(){
        $user = Auth::user();
        return view('admin', ['user'=>$user]);
    }
}
