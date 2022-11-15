<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        // $motivo_contatos = [
        //     '1' => 'Dúvida',
        //     '2' => 'Elogio',
        //     '3' => 'Reclamacão'
        // ];

        return view('site.contato', ['motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request) {

        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // print_r($request->input('nome'));

        // $contato = new SiteContato();
        // $contato->nome = $request->input('nome');
        // $contato->telefone = $request->input('telefone');
        // $contato->email = $request->input('email');
        // $contato->motivo_contato = $request->input('motivo_contato');
        // $contato->mensagem = $request->input('mensagem');
        // $contato->save();

        // $contato = new SiteContato();
        // $contato->fill($request->all());
        // $contato->save();

        // $contato = new SiteContato();
        // $contato->create($request->all());


        $request->validate(
            [
                'nome' => 'required|min:3|max:40|unique:site_contatos',
                'telefone' => 'required',
                'email' => 'email',
                'motivo_contato_id' => 'required',
                'mensagem' => 'required|max:2000'
            ],
            [
                'nome.required' => 'O campo é obrigatorio',
                'nome.min' => 'O nome deve ter no minimo 3 caracters',
                'nome.max' => 'O nome deve ter no maximo 40 caracters',
                'nome.unique' => 'O nome informado ja existe',
                'email.email' => 'Email invalido',
                // podemos passar apenas o validador e criar testo generico para todos
                'required' => 'O campo :attribute é obrigatorio'
            ]
        );
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
