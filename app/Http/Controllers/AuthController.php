<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    //
    public function create(){
        return view('register.create');
    }

    public function loginform(){
        return view('login.create');
    }
    
    public function loginstore(){
        request()->validate([
            'email'=>[ 'required' , 'email'],
            'password' => 'required',
        ]);
        if(auth()->attempt(request(['email','password']))){
            if(auth()->user()->isAdmin() || auth()->user()->isAccountant()){
                return redirect('/admin/products');
            }
            return redirect('/');
        }else{
            return back()->withErrors([
                'email'=> "provided credentials do not match our records.",
            ]);
        }
    }
    
    
    public function store(){
        request()->validate([
            'name' => 'required',
            'email'=>[ 'required' , 'email' , Rule::unique('users','email'),],
            'password' => 'required|confirmed',
            'phone' => 'required|numeric',
        ]);

        $user =new User();
        $user->name =request('name');
        $user->email =request('email');
        $user->password =bcrypt(request('password'));
        $user->phone =request('phone');
        $user->save();
        auth()->login($user);
        return redirect('/');


    }

    public function destory(){
        auth()->logout(); 
        return redirect('/login');
    }   
 

}
