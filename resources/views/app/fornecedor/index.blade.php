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
    Cnpj: {{ $fornecedores[1]['cnpj'] ?? '- vazio' }}
    <br>
    Telefone: ({{ $fornecedores[1]['ddd'] ?? '- vazio' }}) {{ $fornecedores[1]['telefone'] ?? '- vazio' }}
    @switch($fornecedores[1]['ddd'])
        @case('11')
            São Paulo - SP
            @break
        @case('32')
            Juiz de Fora - MG
            @break
        @case('85')
            Fortaleza - CE
            @break
        @default
            Estado não identificado
    @endswitch
@endisset


