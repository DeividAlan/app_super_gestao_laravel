<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');
    }

    public function listar() {
        return view('app.fornecedor.listar');
    }

    public function adicionar(Request $request) {
        $msg = '';

        if($request->input('_token') != '') {

           $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email',
           ];

           $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo :attribute deve ter no minimo 3 caracters',
                'nome.max' => 'O campo :attribute deve ter no maximo 40 caracters',
                'uf.min' => 'O campo :attribute deve ter no minimo 2 caracters',
                'uf.max' => 'O campo :attribute deve ter no maximo 2 caracters',
                'email.email' => 'O campo :attribute não foi preenchido corretamente',
           ];

           $request->validate($regras, $feedback);

           $fornecedor = new Fornecedor();
           $fornecedor->create($request->all());

           //redirect para uma tela de sucesso ou

           //dados de sucesso para mesma tela
           $msg = 'Cadastro realizado com sucesso';
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }
}
