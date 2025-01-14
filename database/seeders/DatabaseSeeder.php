<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
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

      
        $clothes = Category::factory()->create(['name'=> 'clothes']);
        $electronic = Category::factory()->create(['name'=> 'electronic']);

        $product = Product::factory(3)->create(['category_id'=> $clothes->id]);
        $product = Product::factory(3)->create(['category_id'=> $electronic->id]);


        // Order::factory(2)->hasAttached(
        //     Product::factory()->count(3),
        //     ['quantity' =>1 ], 
        //      'products'
        //     )->create();

        //     User::factory()->has(Order::factory()->count(3),'orders')->create();          

            $admin = Role::factory()->create(['name'=>'admin']);
            $user = Role::factory()->create(['name'=>'user']);
            $accountant = Role::factory()->create(['name'=>'accountant']);

            User::factory(1)->create(['role_id'=>$admin->id,'email'=>'admin@gmail.com']);
            User::factory(10)->create(['role_id'=>$user->id]);
            User::factory(1)->create(['role_id'=>$accountant->id,'email'=>'accountant@gmail.com']);
            
    }

    
    
}
