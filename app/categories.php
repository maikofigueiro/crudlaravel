<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class categories extends Model
{
    public function saveCategory($dadosCategory){
    	try{
	        $insert = DB::table('categories')->insert(
	            [$dadosCategory]
	        );
	        return $insert;
        } catch (Exception $e){
            return $e->getMensage();
        }
    }
}
