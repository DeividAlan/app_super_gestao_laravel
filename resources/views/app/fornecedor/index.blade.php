<h3>Fornecedor</h3>


@php
    /*
        if(isset($variavel)) {} //retorna true se a variavel extiver definida
    */
@endphp

{{-- @dd($fornecedores) --}}


@isset($fornecedores)

    @forelse($fornecedores as $index => $fornecedor)
        Fornecedor: {{ $fornecedor['nome'] }}
        @php $fornecedores[$index]['nome'] = 'Novo nome' @endphp
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        Cnpj: {{ $fornecedor['cnpj'] ?? '- vazio' }}
        <br>
        Telefone: ({{ $fornecedor['ddd'] ?? '- vazio' }}) {{ $fornecedor['telefone'] ?? '- vazio' }}
        <hr>
    @empty
        Não existe fornecedores.
    @endforelse
@endisset

<br>



