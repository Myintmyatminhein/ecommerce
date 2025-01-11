<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
   public function index ()
    {
    $products= Product::Filter(['category'=>request('category'), 'search'=>request('search')])->paginate(12);
    return view('welcome' , ['products' => $products, 'categories'=>Category::all()]);

}


 public function show(Product $product) {
    $latestproducts= Product::orderBy('created_at','desc')->take(3)->get();
    $relatedproducts= Product::where('category_id', $product->category_id)->inRandomOrder()->take(4)->get();
    return view('productDetail' , ['latestproducts' => $latestproducts,
                             'product'=>$product, 
                            'relatedproducts'=>$relatedproducts]);
}
}