<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = '';

        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->title;
        }

        return view('products',[
            "title" => "All products" . $title,
            "active" => "products",
            "uri" => $request->getRequestUri(),
            "products" => Product::latest()->filter(request(['search', 'category', 'name']))->paginate(6)->withQueryString(),
            "categories" => Category::all()
        ]);
    }


}
