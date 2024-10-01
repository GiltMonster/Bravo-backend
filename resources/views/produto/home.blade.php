@foreach ($produtos as $produto)
{{dd($produto);}}
    <img src="{{$produto->PRODUTO_PRECO}}" alt="">
    <p>Nome: {{ $produto->PRODUTO_NOME }}</p>
    <p>Valor: {{ $produto->PRODUTO_PRECO }}</p>
    <p>Descrição: {{ $produto->PRODUTO_DESC }}</p>
    <p>Preço: {{ $produto->PRODUTO_PRECO }}</p>
    <hr>

@endforeach
