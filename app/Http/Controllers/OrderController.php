<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(){
            request()->validate([
                'name' => 'required',
                'phone' => 'required',
                'shipping_address' => 'required',
                'screenshot' => 'required|image',
                'notes' => 'required',

            ]);   
            $screenShot = request('screenshot');
            $path ='/storage/' . $screenShot->store('screenshots');
            $user =auth()->user();
            $user->name = request('name');
            $user->phone = request('phone');
            $user->save();

            $order = new Order();
            $order->user_id=auth()->id();
            $order->total =$user->getTotalPrice();
            $order->address = request('shipping_address');
            $order->notes = request('notes');
            $order->screensshot = $path;
            $order->save();
               
            $carts = $user->cartProducts;
            $orderProducts =  [];
            foreach($carts as $cart){
                $orderProducts[$cart->id] = ['quantity' => $cart->pivot->quantity];    
            }
            $order->products()->attach($orderProducts);    
            
            auth()->user()->cartProducts()->detach();
            return redirect('/order-history');
    }


    public function userOrderHistory(){
        return view('order-history', [
            'orders' => auth()->user()->orders()->latest()->paginate(3)
        ]);
    
}

}
