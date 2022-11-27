@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Vizualização do Produto</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 40%; margin-left: auto; margin-right: auto; margin-top: 50px">
                <table border="1" width="100%" style="text-align: left">
                    <tr>
                        <th>ID</th>
                        <th>{{$produto->id}}</th>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <th>{{$produto->nome}}</th>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <th>{{$produto->descricao}}</th>
                    </tr>
                    <tr>
                        <th>Peso</th>
                        <th>{{$produto->peso}} KG</th>
                    </tr>
                    <tr>
                        <th>Unidade ID</th>
                        <th>{{$produto->unidade_id}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
