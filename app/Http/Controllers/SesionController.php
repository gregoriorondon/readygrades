<?php

namespace App\Http\Controllers;

use App\Models\SessionProfesores;
use App\Models\SessionRoot;
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
        // dd(request()->all());
        $credenciales = $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        if (Auth::guard('admins')->attempt([
            'email'=> $credenciales['email'],
            'password'=> $credenciales['password']
        ])) {
            $this->handleSuccessfulLogin($request, 'admins');
            return redirect('/administracion');
        } elseif (Auth::guard('teachers')->attempt([
            'email'=>$credenciales['email'],
            'password'=>$credenciales['password']
        ])) {
            $this->handleSuccessfulLogin($request, 'teachers');
            return redirect('/dashboard');
        } elseif (Auth::guard('root')->attempt([
            'email'=>$credenciales['email'],
            'password'=>$credenciales['password']
        ])) {
            $this->handleSuccessfulLogin($request, 'root');
            return redirect('/administracion');
        }
        throw ValidationException::withMessages([
                'email'=>'Disculpe, los datos no coinciden con ningun usuario registrado',
            ]);
        // Auth::attempt($atributos);
    }
    protected function handleSuccessfulLogin(Request $request, $guard){
        $request->session()->regenerate();
        $sessionToken = Str::uuid()->toString();
        session(['session_token' => $sessionToken]);

        $userId = Auth::guard($guard)->id();

        if ($guard === 'admins') {
            Sessions::create([
                'user_id' => $userId,
                'session_token' => $sessionToken,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
        } elseif ($guard === 'root') {
            SessionRoot::create([
                'root_id'=> $userId,
                'session_token'=>$sessionToken,
                'ip_address'=>$request->ip(),
                'user_agent'=>$request->header('User-Agent'),
            ]);
        } elseif ($guard === 'teachers') {
            SessionProfesores::create([
                'teacher_id'=> $userId,
                'session_token'=>$sessionToken,
                'ip_address'=>$request->ip(),
                'user_agent'=>$request->header('User-Agent'),
            ]);
        }
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
