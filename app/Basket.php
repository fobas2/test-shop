<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['id_basket','id_product','updated_at','created_at'];
	
	public static function inShop($idP) {
    	if (Basket::where('id_product', '=', $idP)->count() == 0)  {
    		return True;
    	} else {
    		return False;
    	}
    }
}
