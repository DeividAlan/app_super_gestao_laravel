<h3>Fornecedor</h3>


@php
    /*
        if(isset($variavel)) {} //retorna true se a variavel extiver definida
    */
@endphp

{{-- @dd($fornecedores) --}}


@isset($fornecedores)
    @for($i = 0; isset($fornecedores[$i]); $i++)
        Fornecedor: {{ $fornecedores[$i]['nome'] }}
        <br>
        Status: {{ $fornecedores[$i]['status'] }}
        <br>
        Cnpj: {{ $fornecedores[$i]['cnpj'] ?? '- vazio' }}
        <br>
        Telefone: ({{ $fornecedores[$i]['ddd'] ?? '- vazio' }}) {{ $fornecedores[1]['telefone'] ?? '- vazio' }}
        <hr>
    @endfor
@endisset

<br>




