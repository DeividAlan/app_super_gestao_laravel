<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request) {
        $erro = $request->get('erro');

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }


    public function autenticar(Request $request) {

        $request->validate(
            [
                'usuario' => 'email',
                'senha' => 'required',
            ],
            [
                'usuario.email' => 'O cmapo usuario (e-mail) é obrigatório',
                'senha.required' => 'O cmapo senha é obrigatório',
            ]
        );

        $usuario = User::where('email', $request->input('usuario'))
            ->where('password', $request->input('senha'))
            ->get()
            ->first();

        if (empty($usuario)){
            return redirect()->route('site.login', ['erro' => 1]);
        } else {
            return 'acessou';
        }
    }
}
