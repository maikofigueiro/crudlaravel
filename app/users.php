<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class users extends Model
{
    public function saveUser($dadosUser){
    	try{
	        $insert = DB::table('users')->insert(
	            [$dadosUser]
	        );
	        return $insert;
        } catch (Exception $e){
            return $e->getMensage();
        }
    }
}
