<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartDetail;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();

        User::create([
            'id' => 4,
            'name' => 'Ryto',
            'username' => 'ryto',
            'email' => 'ryto@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::factory(3)->create();

        Category::create([
            'title' => 'Makanan',
            'slug' => 'makanan',
            'user_id' => 4
        ]);

        Category::create([
            'title' => 'Minuman',
            'slug' => 'minuman',
            'user_id' => 4
        ]);


        Product::create([
            'name' => 'Nasi',
            'description' => 'Terbuat dari beras yang dimasak.',
            'price' => 5000,
            'user_id' => 4,
            'category_id' => 1

        ]);

        Product::create([
            'name' => 'Mi ayam',
            'description' => 'Mi rebus campur daging ayam.',
            'price' => 10000,
            'user_id' => 4,
            'category_id' => 1

        ]);

        Product::create([
            'name' => 'Air Putih',
            'description' => 'Ternyata air putih berwarna bening.',
            'price' => 1000,
            'user_id' => 4,
            'category_id' => 2

        ]);
        Product::create([
            'name' => 'Kopi Gudey',
            'description' => 'Kopi mantap ga bikin ngantuk.',
            'price' => 3000,
            'user_id' => 4,
            'category_id' => 2
        ]);


        Cart::create([
            'user_id' => 4,
            'product_id' => 4,
            'name' => 'Kopi Gudey',
            'price' => 3000,
            'quantity' => 1,
            'subtotal' => 3000,
        ]);



        Post::factory(20)->create();

    }
}
