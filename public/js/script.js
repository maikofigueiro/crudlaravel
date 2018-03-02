$(document).ready(function(){

    // ajax para o formulario de usuario
    $('#saveUser').on('click', function(){
        // token de seguranca da view
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var name = $('#name').val();
        var userscol = $('#userscol').val();
        var $html = $('.users_select');

        if(name == ''){
            alert('Necessário preencher o nome!');
            return false;
        } else {
            $.ajax({
                type: 'POST',
                data: {name, userscol},
                url: 'index/user',
                success: function (e)
                {
                    // aviso de sucesso
                    alert('User salvo com sucesso!');

                    // limpando formulario
                    $('#name').val('');
                    $('#userscol').val('');

                    // limpando select antes de popula-lo novamente
                    $html.empty();

                    // montando o select select de user do post
                    $.each(e, function(i, v) {
                        option = new Option(v,i);
                        $($html).append(option);
                    });
                },
                error: function(e)
                {
                    alert("Ocorreu um erro ao salvar os dados. Erro: "+e.responseJSON['message']);
                }
            });
        }
    })
    // ajax para o formulario de categoria
    $('#saveCategory').on('click', function(){
        // token de seguranca da view
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var category = $('#title_category').val();
        var $html = $('.category_select');

        if(category == ''){
            alert('Necessário preencher o titulo!');
            return false;
        } else {
            $.ajax({
                type: 'POST',
                data: {category},
                url: 'index/category',
                success: function (e)
                {
                    // aviso de sucesso
                    alert('Categoria salvo com sucesso!');

                    // limpando select antes de popula-lo novamente
                    $html.empty();

                    $('#title_category').val('');

                    // montando o select de categoria do post
                    $.each(e, function(i, v) {
                        option = new Option(v,i);
                        $($html).append(option);
                    });
                },
                error: function(e)
                {
                    alert("Ocorreu um erro ao salvar os dados. Erro: "+e.responseJSON['message']);
                }
            });
        }
    })
    // ajax para o formulario de post
    $('#savePost').on('click', function(){
        // token de seguranca da view
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var title = $('#title').val();
        var content = $('#content').val();
        var title_tag = $('#title_tag').val();
        var user_id = $('#user_id').val();
        var category_id = $('#category_id').val();
        var $html = $('.post_select');

        if(title == '' || title_tag == 0 || user_id == 0){
            alert('* Campos obrigatórios!');
            return false;
        } else {
            // ajax para salvar o post
            $.ajax({
                type: 'POST',
                data: {title, content, title_tag, user_id, category_id},
                url: 'index/post',
                success: function (e)
                {
                    // limpando vormulario
                    $('#title').val('');
                    $('#content').val('');
                    $('#title_tag').val('');
                    $('#user_id').val(0);
                    $('#category_id').val(0);
                    $html.empty();

                    // aviso de sucesso
                    alert('Post salvo com sucesso!');

                    // montando o select do campo x com o posto que acabou de ser salvo
                    $.each(e, function(i, v) {
                        option = new Option(v,i);
                        $($html).append(option);
                    });
                },
                error: function(e)
                {
                    alert("Ocorreu um erro ao salvar os dados. Erro: "+e.responseJSON['message']);
                }
            });
        }
    })
    // ajax para o formulario de campo x
    $('#campoX').on('click', function(){
        // token de seguranca da view
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var campo_x = $('#campo_x').val();
        var $html = $('.resultCampoX');

        if(campo_x == 0){
            alert('Nenhum post selecionado.');
            return false;
        } else {
            // ajax para consultar o campo x
            $.ajax({
                type: 'POST',
                data: {campo_x},
                url: 'index/find-campo-x',
                success: function (e)
                {
                    $($html).empty();
                    if(e){
                        $($html).append('Campo X: '+e);
                    }else{
                        $($html).append('Campo X não encontrado.');
                    }

                }
            });
        }
    })

    $('.edit').on('click', function(){
        var target = $(this).closest('[data-id]');
        edit(1, target.data('id'));
    })

    $('.delete').on('click', function(){
        var target = $(this).closest('[data-id]');
        edit(2, target.data('id'));
    })

    function edit($config, $id){

        // token de seguranca da view
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $id;
        var config = $config;
        var val = $('.name_'+$id).val();
        var action = $('.action').val();

        if(val == ''){
            alert('Nome não pode ser vazio.');
            return false;
        }

        // ajax para edicao
        $.ajax({
            type: 'POST',
            data: {config, id, val, action},
            url: '/index/edit',
            success: function (e)
            {
                alert('Alterado com sucesso!');
                location.reload();
            },
            error: function (e)
            {
                alert('Usuarios ou Categorias não podem ser deletadas se estiverem vinculadas a algum Post. Delete o Post primeiro.');
            }

        });
    }
})