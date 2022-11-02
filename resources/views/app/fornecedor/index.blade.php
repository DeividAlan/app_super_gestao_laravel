<h3>Fornecedor</h3>


@php
    /*
        if(isset($variavel)) {} //retorna true se a variavel extiver definida
    */
@endphp

{{-- @dd($fornecedores) --}}


@isset($fornecedores)
    Fornecedor: {{ $fornecedores[1]['nome'] }}
    <br>
    Status: {{ $fornecedores[1]['status'] }}
    <br>
    @isset($fornecedores[1]['cnpj'])
        Cnpj: {{ $fornecedores[1]['cnpj'] }}
    @endisset
@endisset


