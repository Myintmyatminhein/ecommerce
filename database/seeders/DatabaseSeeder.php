<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      
        // $clothes = Category::factory()->create(['name'=> 'clothes']);
        // $electronic = Category::factory()->create(['name'=> 'electronic']);

        // $product = Product::factory(3)->create(['category_id'=> $clothes->id]);
        // $product = Product::factory(3)->create(['category_id'=> $electronic->id]);


        Order::factory(2)->hasAttached(
            Product::factory()->count(3),
            ['quantity' =>1 ], 
             'products'
            )->create();

            User::factory()->has(Order::factory()->count(3),'orders')->create();          
            
    }

    
    
}
