<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller {

    public function getData(){
      $product = Product::paginate(4);
      return view('home', compact('product'));
    }

}
