<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Mail\ProductCreatedMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
class AdminProductController extends Controller
{

    public function index (){
        $products = Product::with('category')->orderBy('created_at','desc')->get(); 
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

        $users = User::all();
        $users->each(function($user) use ($product){
             Mail::to($user->email)->queue(new ProductCreatedMail($product, $user->name));
        }); 
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
