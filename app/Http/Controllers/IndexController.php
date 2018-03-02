<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use App\categories;
use App\posts;
use App\tags;
use App\post_tag;

class IndexController extends Controller
{
    public function index()
    {
        // iniciando models
        $modelUser = new users();
        $modelCategory = new categories();
        $modelPost = new posts();

        // variaveis do form select
        $users[0] = 'Register a User';
        $categories[0] = 'Register a Category';
        $posts[0] = 'Register a Post';

        // consultando a tabela de users e validando o retorno
        $findUsers = $modelUser->all('id','nome');
        foreach ($findUsers as $key => $value) {
            if(!empty($value)){
                $users[0] = '* Select User';
                $users[$value['id']] = $value['nome'];
            }
        }

        // consultando a tabela de categories e validando o retorno
        $findCategories = $modelCategory->all('id','titulo');
        foreach ($findCategories as $key => $value) {
            if(!empty($value)){
                $categories[0] = '* Select Categories';
                $categories[$value['id']] = $value['titulo'];
            }
        }

        // consultando a tabela de posts e validando o retorno
        $findPost = $modelPost->all('id','titulo');
        foreach ($findPost as $key => $value) {
            if(!empty($value)){
                $posts[0] = '* Select Post';
                $posts[$value['id']] = $value['titulo'];
            }
        }

        // retornando a view e dados dos form selecst
        return view('index', ['users'=>$users, 'categories'=>$categories, 'posts'=>$posts]);
    }

    public function user(Request $post)
    {
        // iniciando model
        $modelUsers = new users();

        // variaveis do form select
        $users[] = '* Select User';

        // rebendo dados do post e gravando na variavel que salvara na tabela
        $dadosUser = [
            'nome' => $post->get('name'),
            'userscol' => $post->get('userscol')
        ];

        // enviando os dados para a model
        $saveUser = $modelUsers->saveUser($dadosUser);

        // validando retorno
        if($saveUser){
            $findUsers = $modelUsers->all('id', 'nome');
            foreach ($findUsers as $key => $value) {
                $users[$value['id']] = $value['nome'];
            }
        }

        return $users;

    }

    public function category(Request $post)
    {
        // iniciando model
        $modelCategory = new categories();

        // variaveis do form select
        $categories[] = '* Select Categories';

        // rebendo dados do post e gravando na variavel que salvara na tabela
        $dadosCategory = [
            'titulo' => $post->get('category')
        ];

        // enviando os dados para a model
        $saveCategory = $modelCategory->saveCategory($dadosCategory);

        // validando retorno
        if($saveCategory){
            $findCategories = $modelCategory->all('id', 'titulo');
            foreach ($findCategories as $key => $value) {
                $categories[$value['id']] = $value['titulo'];
            }
        }

        return $categories;
    }

    public function post(Request $post)
    {
        // iniciando models
        $modelPosts = new posts();
        $modelTags = new tags();
        $modelPostTag = new post_tag();

        // variaveis do form select
        $posts[] = '* Select Post';

        // rebendo dados do post e gravando na variavel que salvara na tabela
        $dadosPost = [
            'titulo'        => $post->get('title'),
            'conteudo'      => $post->get('content'),
            'category_id'   => $post->get('category_id'),
            'user_id'       => $post->get('user_id')
        ];
        $dadosTag = [
            'titulo' => $post->get('title_tag')
        ];

        // enviando os dados para a model
        $savePost = $modelPosts->savePost($dadosPost);
        $saveTag = $modelTags->saveTag($dadosTag);


        // validando retorno
        if($savePost && $saveTag){

            // gerando um numero qualquer para o campo x
            $random = '#'.strtoupper(substr(bin2hex(random_bytes(4)), 1));
            $dadosPostTag = [
                'post_id'   => $savePost,
                'tag_id'    => $saveTag,
                'campo_x'   => $random
            ];
            // enviando os dados para a model
            $savePostTag = $modelPostTag->savePostTag($dadosPostTag);

            // validando retorno
            if($savePostTag){
                $findPost = $modelPosts->all('id', 'titulo');
                foreach ($findPost as $key => $value) {
                    $posts[$value['id']] = $value['titulo'];
                }

                return $posts;
            }

            return $savePostTag;
        }

    }

    public function findCampoX(Request $post)
    {
        // iniciando model
        $modelPostTag = new post_tag();

        // variaveis do form select
        $posts[] = '* Select Post';

        // consultando o campo x de acordo com o post
        $findCampoX = $modelPostTag->findCampoX($post->get('campo_x'));

        return $findCampoX;
    }

    public function edit(Request $post)
    {
        // iniciando models
        $modelUser = new users();
        $modelCategory = new categories();
        $modelPost = new posts();
        $modelPostTag = new post_tag();

        // se houve post, valida os dados e os executa
        if(!empty($post->get('id')) && $post->get('config') == 1){
            try{
                switch ($post->get('action')) {
                    case 'user':
                        $dadoUpdate = [
                            'nome' => $post->get('val')
                        ];
                        $modelUser->where('id', $post->get('id'))->update($dadoUpdate);
                        break;
                    case 'category':
                        $dadoUpdate = [
                            'titulo' => $post->get('val')
                        ];
                        $modelCategory->where('id', $post->get('id'))->update($dadoUpdate);
                        break;
                    case 'post':
                        $dadoUpdate = [
                            'titulo' => $post->get('val')
                        ];
                        $modelPost->where('id', $post->get('id'))->update($dadoUpdate);
                        break;
                }
            } catch (Exception $e){
                return $e->getMensage();
            }
        } elseif(!empty($post->get('id')) && $post->get('config') == 2){
            try{
                switch ($post->get('action')) {
                    case 'user':
                        $dropUser = $modelUser->where('id', $post->get('id'))->delete();
                        break;
                    case 'category':
                        $dropCategory = $modelCategory->where('id', $post->get('id'))->delete();
                        break;
                    case 'post':
                        $dropPostTag = $modelPostTag->dropPostTag($post->get('id'));
                        $dropPost = $modelPost->where('id', $post->get('id'))->delete();
                        break;
                }
            } catch (Exception $e){
                return $e->getMensage();
            }
        }

        switch ($post->action) {
            case 'user':
                // iniciando variavel
                $users = [];
                // consultando a tabela de users e validando o retorno
                $findUsers = $modelUser->all('id','nome');
                foreach ($findUsers as $key => $value) {
                    if(!empty($value)){
                        $users[$value['id']] = $value['nome'];
                    }
                }
                return view('editUser', ['users'=>$users]);
                break;
            case 'category':
                // iniciando variavel
                $categories = [];
                // consultando a tabela de categories e validando o retorno
                $findUsers = $modelCategory->all('id','titulo');
                foreach ($findUsers as $key => $value) {
                    if(!empty($value)){
                        $categories[$value['id']] = $value['titulo'];
                    }
                }
                return view('editCategory', ['categories'=>$categories]);
                break;
            case 'post':
                // iniciando variavel
                $posts = [];
                // consultando a tabela de posts e validando o retorno
                $findUsers = $modelPost->all('id','titulo');
                foreach ($findUsers as $key => $value) {
                    if(!empty($value)){
                        $posts[$value['id']] = $value['titulo'];
                    }
                }
                return view('editPost', ['posts'=>$posts]);
                break;
        }
    }
}
