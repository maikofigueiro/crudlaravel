<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class posts extends Model
{
    public function savePost($dadosPost){
	    try{
	        $insert = DB::table('posts')->insert(
	            [$dadosPost]
	        );
	        $id = DB::getPdo()->lastInsertId();
	        return $id;
        } catch (Exception $e){
            return $e->getMensage();
        }
    }
}