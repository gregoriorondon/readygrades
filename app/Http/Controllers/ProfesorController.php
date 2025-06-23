<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Nucleos;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    //
    public function board(){
        $user = Auth::guard('teachers')->user();
        // $user = Auth::user();
        $carreras = Carreras::count();
        $estudiantes = Students::count();
        $nucleos = Nucleos::count();

        return view('auth.admin', compact('user', 'carreras', 'estudiantes', 'nucleos'));
    }
}
