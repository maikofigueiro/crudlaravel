@extends('default')

@section('title', 'Teste Laravel')

@section('content')
    <div>
        @if(!empty($categories))
            <h2>Editar categorias</h2>
            <input type="hidden" name="category" class="action" value="category">
            @foreach ($categories as $key => $value)
                <div data-id="{{ $key }}">
                    <input type="hidden" name="{{ $key }}" class="id_name" value="{{ $key }}">
                    <input type="text" name="{{ $key }}" class="name_{{ $key }}" value="{{ $value }}">
                    <button class="edit">Salvar</button>
                    <button class="delete">Apagar</button>
                    <br><br>
                </div>
            @endforeach
        @else
            Nenhuma categoria cadastrado.
        @endif
        <br>
        <a href="/">Voltar a tela de principal</a>
    </div>
@endsection