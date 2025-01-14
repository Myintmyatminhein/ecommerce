<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{

    public function index (){
        $products = Product::orderBy('created_at','desc')->get(); 
        return view('admin', ['products'=> $products]);
    }



    public function create(){
        return view ('productCreate', ['categories'=> Category::all()]);
    }



    public function store(ProductRequest $request){
        $path = '/storage/'.request('photo')->store('products');
       $product =new Product();
       $product->name = $request->name; 
       $product->photo = $path;
       $product->price = $request->price;  
       $product->description = $request->description;  
       $product->category_id = $request->category_id;
       $product->save();

      return redirect('/admin/products');
    }


    public function destroy(Product $product){
        $product->delete();
        return redirect('/admin/products');
    }


    public function update(Product $product , ProductRequest $request){

        $product->name = $request->name; 
        $product->price = $request->price;  
        $product->description = $request->description;  
        $product->category_id = $request->category_id;
        $product->save();

      return redirect('/admin/products');
    }



    public function edit(Product $product){
        return view('edit',['categories'=> Category::all(), 'product'=> $product]);
    }
}
