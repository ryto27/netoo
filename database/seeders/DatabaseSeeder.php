<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Table;
use App\Models\Order;
use App\Models\OrderDetail;




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

        User::create([
            'name' => 'Ryan',
            'username' => 'ryan',
            'email' => 'ryan@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user'
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

        Product::create([
            'name' => 'Teh',
            'description' => 'ngeteh',
            'price' => 3000,
            'user_id' => 4,
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Susu',
            'description' => 'Banyu Putih.',
            'price' => 5000,
            'user_id' => 4,
            'category_id' => 2
        ]);
        Product::create([
            'name' => 'Bakso',
            'description' => 'Kedok intel',
            'price' => 10000,
            'user_id' => 4,
            'category_id' => 1
        ]);


        Cart::create([
            'user_id' => 4,
            'status_cart' => 'cart',
            'status_pembayaran' => 'belum',
            'total_qty' => 2,
            'total' => 8000,
        ]);

        CartDetail::create([
            'product_id' => 1,
            'cart_id' => 1,
            'qty' => 1,
            'harga' => 5000,
            'subtotal' => 5000,
        ]);

        CartDetail::create([
            'product_id' => 4,
            'cart_id' => 1,
            'qty' => 1,
            'harga' => 3000,
            'subtotal' => 3000,
        ]);

        Order::create([
            'user_id' => 4,
            'cart_id' => 1,
        ]);

        Table::create([
            'user_id' => 1,
            'status' => 'occupied',
            'number' => 1
        ]);

        Post::factory(20)->create();

    }
}
