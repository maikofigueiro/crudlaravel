@extends('default')

@section('title', 'Teste Laravel')

@section('content')
    <div>
        @if(!empty($posts))
            <h2>Editar Postagens</h2>
            <input type="hidden" name="post" class="action" value="post">
            @foreach ($posts as $key => $value)
                <div data-id="{{ $key }}">
                    <input type="hidden" name="{{ $key }}" class="id_name" value="{{ $key }}">
                    <input type="text" name="{{ $key }}" class="name_{{ $key }}" value="{{ $value }}">
                    <button class="edit">Salvar</button>
                    <button class="delete">Apagar</button>
                    <br><br>
                </div>
            @endforeach
        @else
            Nenhuma postagem cadastrado.
        @endif
        <br>
        <a href="/">Voltar a tela de principal</a>
    </div>
@endsection