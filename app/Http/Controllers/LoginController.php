<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request) {
        $erro = $request->get('erro');

        if($erro == 1) {
            $msgErro = 'O usuario ou senha esta errado';
        } else if ($erro == 2) {
            $msgErro = 'Pagina acessada apenas com altenticação, favro realizar login';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $msgErro]);
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
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.clientes');
        }
    }
}
