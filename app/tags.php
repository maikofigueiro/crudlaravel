<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class tags extends Model
{
    public function saveTag($dadosTag){
	    try{
	        $insert = DB::table('tags')->insert(
	            [$dadosTag]
	        );
	        $id = DB::getPdo()->lastInsertId();
	        return $id;
        } catch (Exception  $e){
            return $e->getMensage();
        }
    }
}