@foreach ($categorias as $categoria)
<h1>{{$categoria->CATEGORIA_NOME}}</h1>


@foreach ($categoria->produtos as $produto )
{{dd($categoria->produtos)}}
<p>{{$produto->PRODUTO_NOME}}</p>

@endforeach
@endforeach
