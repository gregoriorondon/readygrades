<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SesionController extends Controller
{
    //
    public function create(){
        return view('auth.login');
    }
    public function store(){
        /* dd(request()->all()); */
        $atributos = request()->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        if (! Auth::attempt($atributos)) {
            throw ValidationException::withMessages([
                'email'=>'Disculpe, los datos no coinciden con ningun usuario registrado',
            ]);
        }
        Auth::attempt($atributos);
        request()->session()->regenerate();
        return redirect('/administracion');
    }
    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
