<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class post_tag extends Model
{
    public function savePostTag($dadosPostTag){
    	try{
		    $insert = DB::table('post_tag')->insert(
		        [$dadosPostTag]
		    );
		    return $insert;
        } catch (Exception $e){
            return $e->getMensage();
        }
    }

    public function findCampoX($idPost){
    	$campoX = DB::table('post_tag')->where('post_id', $idPost)->value('campo_x');
    	return $campoX;
    }

    public function dropPostTag($idPost){
        $campoX = DB::table('post_tag')->where('post_id', $idPost)->delete();
        return $campoX;
    }
}
