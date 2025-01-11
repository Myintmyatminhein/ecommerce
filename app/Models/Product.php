<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded =[];

    //a product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query , $filter){
        $query->when(isset($filter['search']),function ($query) use ($filter){
            return $query->  where('name','LIKE','%'. $filter['search'].'%');
        })
        
        ->when(isset($filter['category']),function($query) use($filter) {
                    $query->whereHas('category',function($query) use($filter) {
         return $query->where('id',$filter['category']);
                });
        })
       
        ->latest();
        
    }
        //a product belongsMany to cartUsers
    public function cartUsers(){
        return $this->belongsToMany(User::class, 'carts' )->withPivot("quantity");
}

    // a product belongsToMany orders
    public function orders(){
        return $this->belongsToMany(Order::class, 'order_details')->withPivot("quantity");
    }
}
