<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request) {
        $fornecedores = Fornecedor::with(['produtos'])
            ->where('nome', 'like', "%{$request->input('nome')}%")
            ->where('site', 'like', "%{$request->input('site')}%")
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->paginate(2);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all() ]);
    }

    public function adicionar(Request $request) {
        $msg = '';

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

        if($request->input('_token') != '' && $request->input('id') == '') {
           $request->validate($regras, $feedback);

           $fornecedor = new Fornecedor();
           $fornecedor->create($request->all());

           //redirect para uma tela de sucesso ou

           //dados de sucesso para mesma tela
           $msg = 'Cadastro realizado com sucesso';
        }

        if($request->input('_token') != '' && $request->input('id') != '') {
            $request->validate($regras, $feedback);

            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = 'Atualziação realizada com sucesso';
            } else {
                $msg = 'Erro ao tentar atualizar o registro';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '') {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id, $msg = '') {
        $fornecedor = Fornecedor::find($id)->delete();

        return redirect()->route('app.fornecedor');
    }
}
