@foreach ($produtos as $produto)
    @foreach ($produto->imagens as $imagem)
        <img style="width: 30%; height: auto;" src="{{ $imagem->IMAGEM_URL }}" alt="{{ $produto->PRODUTO_NOME }}">
    @endforeach
    <h2>{{ $produto->PRODUTO_NOME }} - {{ $produto->PRODUTO_PRECO }}</h2>
@endforeach
