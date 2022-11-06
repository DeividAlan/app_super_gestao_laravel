<h3>Fornecedor</h3>


@php
    /*
        if(isset($variavel)) {} //retorna true se a variavel extiver definida
    */
@endphp

{{-- @dd($fornecedores) --}}


@isset($fornecedores)

    @php $i = 0 @endphp
    @while(isset($fornecedores[$i]))
        Fornecedor: {{ $fornecedores[$i]['nome'] }}
        <br>
        Status: {{ $fornecedores[$i]['status'] }}
        <br>
        Cnpj: {{ $fornecedores[$i]['cnpj'] ?? '- vazio' }}
        <br>
        Telefone: ({{ $fornecedores[$i]['ddd'] ?? '- vazio' }}) {{ $fornecedores[1]['telefone'] ?? '- vazio' }}
        <hr>
        @php $i++ @endphp
    @endwhile
@endisset

<br>




