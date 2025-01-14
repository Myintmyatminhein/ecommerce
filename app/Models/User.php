<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    // a user belongsToMany cartProducts
    public function cartProducts(){
                return $this->belongsToMany(Product::class, 'carts' )->withPivot("quantity");
    }

    public function getTotalPrice(){

       $productsPriceWithQuantity = $this->cartProducts->map(function ($product){
            return [
                    'quantity'=> $product->pivot->quantity,
                    'price' => $product->price
            ];
        }); 
        $total = 0;

        $productsPriceWithQuantity->each(function ($product) use (&$total){
             return $total+=$product['price']*$product['quantity'];
        });
       return $total;
    }
    // a user hasMany Orders
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function isAdmin(){
        return $this->role_id == 1;
    }
    public function isAccountant(){
        return $this->role_id == 3; 
    }
}
