@extends('layouts.main')

@section('container')


    <h1 class="mb-5 text-center">{{ $title }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/products">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('products'))
                    <input type="hidden" name="products" value="{{ request('products') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif

@if ( $products->count() )

<div class="container">
    <div class="row">
    @foreach ($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2 d-flex justify-content-between" style="background-color:rgba(0, 0, 0, 0.7)"><a href="/products?category={{ $product->category->slug }}" class="text-white text-decoration-none">{{ $product->category->title }}</a></div>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->category->title }}" class="img-fluid">
                    @else
                        <img src="https://mypetsindonesia.com/my-assets/image/no-image.jpg" class="card-img-top" alt="{{ $product->category->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">{{ $product->price }}</p>
                    
                    <form action="/cart" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->image }}" name="image">
                        <input type="hidden" value="1" name="quantity">
                        <input type="hidden" value="{{ $product->price }}" name="subtotal">
                        <button type="submit" class="btn btn-sm btn-info mb-2">Add to Cart</button>                      
                    </form>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>

@else
    <p class="text-center fs-4"> No menu found.</p>
@endif

<div class="d-flex justify-content-center">
{{ $products->links() }}
</div>

@endsection