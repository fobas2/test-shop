<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Basket;

class ShopController extends Controller
{

    public function index() {    	
		$products = Product::statusVisibility();
    	$shops = Basket::all();  
    	$allPrice = 0;  	
    	return view('basket', compact('products','shops','allPrice'));
    }

    public function addProduct(request $request) {

    	if (Basket::inShop($request->idProduct))  {
	    	$Prod = new Basket();
	    	$Prod->id_product = $request->idProduct;
	    	$Prod->save();

	    	return response()->json(['success'=>'success']);
    	} else {
    		return response()->json(['success'=>'error']);
    	}
    }
}
