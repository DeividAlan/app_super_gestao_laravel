<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();

        return view(
            'app.pedido_produto.create',
            ['pedido' => $pedido, 'produtos' => $produtos]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'qtd' => 'required',
        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não exite',
            'required' => 'Favor preencher o campo quantidade',
        ];

        $request->validate($regras, $feedback);

        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->qtd = $request->get('qtd');
        $pedidoProduto->save();

        // // inserção unica sem precisar utilizar o model da tabela de interseção
        // $pedido->produtos()->attach(
        //     $request->get('produto_id'),
        //     [
        //         'qtd' => $request->get('qtd'),
        //         'coluna_2' => 'valor',
        //         'coluna_3' => 'valor',
        //     ]
        // );

        // // inserção de varios produtos de uma unica vez
        // $pedido->produtos()->attach([
        //     $request->get('produto_id') => ['qtd' => $request->get('qtd')],
        //     $request->get('produto_id') => ['qtd' => $request->get('qtd')],
        //     $request->get('produto_id') => ['qtd' => $request->get('qtd')],
        //     $request->get('produto_id') => ['qtd' => $request->get('qtd')],
        // ]);


        return redirect()->route(
            'pedido-produto.create',
            ['pedido' => $pedido->id]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoProduto $pedidoProduto)
    {
        // //convencional
        // PedidoProduto::where([
        //     'pedido_id' => $pedido->id,
        //     'produto_id' => $produto->id,
        // ])->delete();

        // //utilizando o relacionamento
        // $pedido->produtos()->detach($produto->id);

        $pedidoProduto->delete();

        return redirect()->route(
            'pedido-produto.create',
            ['pedido' => $pedidoProduto->pedido_id]
        );
    }
}
