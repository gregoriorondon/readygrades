<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class SesionController extends Controller
{
    //
    public function create(){
        return view('auth.login');
    }
    public function createteacher(){
        return view('auth.loginprofesores');
    }
    public function store(Request $request){
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

        $sessionToken = Str::uuid()->toString();

        session(['session_token' => $sessionToken]);

        Sessions::create([
            'user_id' => Auth::id(),
            'session_token' => $sessionToken,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return redirect('/administracion');
    }
    public function destroy(Request $request){
        $token = session('session_token');

        if ($token) {
            Sessions::where('session_token', $token)->delete();
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
