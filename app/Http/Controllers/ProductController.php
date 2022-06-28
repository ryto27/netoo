<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';

        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->title;
        }

        return view('products',[
            "title" => "All products" . $title,
            "active" => "products",
            "products" => Product::latest()->filter(request(['search', 'category', 'name']))->paginate(6)->withQueryString(),
            "categories" => Category::all()
        ]);
    }


}
