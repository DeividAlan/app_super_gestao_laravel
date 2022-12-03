<?php

namespace App\Http\Controllers;

use App\Produto;
use App\ProdutoDetalhe;
use App\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Produto::paginate(10);

        // foreach($produtos as $key => $produto) {
        //     // print_r($produto->getAttributes());
        //     // echo '<br><br>';

        //     $produto_detalhe = ProdutoDetalhe::where('produto_id', $produto->id)
        //     ->first();

        //     if(isset($produto_detalhe)) {
        //         // print_r($produto_detalhe->getAttributes());

        //         $produtos[$key]['comprimento'] = $produto_detalhe->comprimento;
        //         $produtos[$key]['largura'] = $produto_detalhe->largura;
        //         $produtos[$key]['altura'] = $produto_detalhe->altura;
        //     }
        //     // echo '<hr>';
        // }

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:200',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo Nome deve ter no minimo 3 caracters',
            'nome.max' => 'O campo Nome deve ter no maximo 40 caracters',
            'descricao.min' => 'O campo Dewscrição deve ter no minimo 3 caracters',
            'descricao.max' => 'O campo Dewscrição deve ter no maximo 200 caracters',
            'peso.integer' => 'O campo Peso deve ser um numero inteiro',
            'unidade_id.exists' => 'O campo unidade não existe',
        ];

        $request->validate($regras, $feedback);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);
        // return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:200',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo Nome deve ter no minimo 3 caracters',
            'nome.max' => 'O campo Nome deve ter no maximo 40 caracters',
            'descricao.min' => 'O campo Dewscrição deve ter no minimo 3 caracters',
            'descricao.max' => 'O campo Dewscrição deve ter no maximo 200 caracters',
            'peso.integer' => 'O campo Peso deve ser um numero inteiro',
            'unidade_id.exists' => 'O campo unidade não existe',
        ];

        $request->validate($regras, $feedback);

        $produto->update($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
