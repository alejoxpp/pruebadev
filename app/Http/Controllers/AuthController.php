<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $datos = $request->validate([
            'identificador' => ['required', 'string', 'max:130'],
            'password' => ['required', 'string'],
        ]);

        $campoLogin = filter_var($datos['identificador'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $credenciales = [
            $campoLogin => $datos['identificador'],
            'password' => $datos['password'],
            'active' => true,
        ];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            return redirect()->intended(route('contribuyentes.index'));
        }

        return back()
            ->withErrors(['identificador' => 'Credenciales incorrectas o cuenta inactiva.'])
            ->onlyInput('identificador');
            }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}