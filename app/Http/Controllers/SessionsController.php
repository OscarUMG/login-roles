<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store() {
        if(auth()->attempt(request(['name', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'El correo o la contraseña es incorrecto, por favor prueba de nuevo.',
            ]);
        }else {
            if(auth()->user()->role == 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->to('/');
            }
        }
    }

    public function destroy() {
        auth()->logout();
        
        return redirect()->to('/');
    }
}
