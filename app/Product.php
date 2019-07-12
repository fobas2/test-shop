<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{    
    protected $fillable = ['id_product','name', 'description', 'price', 'isNew', 'isStock', 'status_visibility'];

    protected $primaryKey = 'id_product';   

    public static function statusVisibility()
  	{
    	return static::where('status_visibility', 1)->get();
  	}
}
