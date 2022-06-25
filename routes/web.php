<?php


use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LaporanController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function ()
{
    return view('home', [
        "title" => "Home",
        "active" => "home"
    ]);
});

Route::get('/about', function ()
{
    return view('about', [
        "title" => "About",
        "active" => "about",
        "name" => "Ryto",
        "email" => "my@email.com",
        "images" => "zhongli.jpeg"
    ]);
});
Route::get('/products', [DashboardProductController::class, 'index'] );

Route::get('/posts', [PostController::class, 'index'] );
Route::get('/products', [ProductController::class, 'index'] );
Route::get('/orders', [OrderController::class, 'index'] );


//halaman single post
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
return view('dashboard.index');
})->middleware('admin');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin'); //admin only

Route::resource('/dashboard/products', DashboardProductController::class)->middleware('auth');

Route::resource('/dashboard/cart', CartController::class)->middleware('auth');

Route::resource('/cart', CartController::class)->middleware('auth');
Route::resource('/cartdetail', CartDetailController::class)->middleware('auth');
Route::patch('/kosongkan/{id}', [CartController::class, 'kosongkan']);

Route::resource('/dashboard/orders', DashboardOrderController::class)->middleware('admin');
Route::resource('/orders', OrderController::class)->middleware('auth');
Route::resource('/detail', OrderDetailController::class)->middleware('auth');
Route::get('/dashboard/orders/{id}', [OrderController::class, 'show']);

Route::resource('/dashboard/tables', TableController::class)->middleware('auth');

  // form laporan
Route::get('laporan', [LaporanController::class, 'index']);
  // proses laporan
Route::get('proseslaporan', [LaporanController::class, 'proses']);
