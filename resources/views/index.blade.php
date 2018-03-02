@extends('default')

@section('title', 'Teste Laravel')

@section('content')
    <div>
        <h2>Users</h2>
        <a href="index/editUser/user">Editar usuarios</a><br><br>
        <input type="text" id="name" name="name" placeholder="* name">
        <input type="text" id="userscol" name="userscol" placeholder="userscol">
        <button id="saveUser">Salvar</button>
    </div>
    <br>
    <div>
        <h2>Categories</h2>
        <a href="index/editCategory/category">Editar categorias</a><br><br>
        <input type="text" id="title_category" name="title_category" placeholder="* title">
        <button id="saveCategory">Salvar</button>
    </div>
    <br>
    <div>
        <h2>Post</h2>
        <a href="index/editPost/post">Editar Postagens</a><br><br>
        <input type="text" id="title" name="title" placeholder="* title">
        <input type="text" id="content" name="content" placeholder="content">
        <input type="text" id="title_tag" name="title_tag" placeholder="tag">
        {!! Form::select('user_id', $users, null, ['class' => 'users_select', 'id' => 'user_id', 'style' => "width: 173px;"]) !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'category_select', 'id' => 'category_id', 'style' => "width: 173px;"]) !!}
        <button id="savePost">Salvar</button>
    </div>
    <div>
        <h2>Buscar Campo X</h2>
        {!! Form::select('campo_x', $posts, null, ['class' => 'post_select', 'id' => 'campo_x', 'style' => "width: 173px;"]) !!}
        <button id="campoX">Buscar Campo X</button>
    </div>
    <dir>
        <h2 class="resultCampoX"></h2>
    </dir>
@endsection