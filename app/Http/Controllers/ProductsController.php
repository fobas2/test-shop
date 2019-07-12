<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Basket;

class ProductsController extends Controller
{
    public function index() {
		$products = Product::statusVisibility();
		$shops = Basket::all();
		$Title = "Товары";		
		$bCol = 0;	
		$inShop = 0;
    	return view('product.index', compact('products','Title','shops','bCol','inShop'));
    }

    public function view($id) {
    	$product = Product::find($id);    
    	$shops = Basket::all();	
    	$inShop = 0;
    	return view('product.view', compact('product','shops','inShop'));
    }

}
