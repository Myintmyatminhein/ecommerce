<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
   // an order belongsTo a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //a order belongsToMany products
    public function products(){
        return $this->belongsToMany(Product::class, 'order_details')->withPivot("quantity");
    }  
}
