<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller
{
    public static function middleware():array{
        return [new Middleware('can:manage, category', except:['index', 'create', 'store','destroy','update','edit'])];
    }

    public function index(){
        return view('admin.categories.index',['categories'=> Category::all()]);
    }
    public function create(){
        if(!auth()->user()->can('manage',Category::class)){
            abort(403);

        }
        return view('admin.categories.categoriescreate',['categories'=> Category::all()]);
    }

    public function edit(Category $category){
        if(!auth()->user()->can('manage',Category::class)){
            abort(403);

        }
        return view('admin.categories.categoriesedit',['category'=>$category]);
    }

    public function store(CategoryRequest $request){
        if(!auth()->user()->can('manage',Category::class)){
            abort(403);

        }
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index');
    }

    public function update(CategoryRequest $request, Category $category){
        if(!auth()->user()->can('manage',Category::class)){
            abort(403);

        }
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('categories.index');
    }
}

