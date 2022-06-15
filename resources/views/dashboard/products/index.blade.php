@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Products</h1>
</div>

@if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif



<!-- <div class="table-responsive col-lg-8">
    
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->category->title }}</td>
                <td>
                    <a href="/dashboard/products/{{ $product->name }}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/products/{{ $product->name }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/products/{{ $product->name }}" method="product" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure you want to delete this?')"><span data-feather="x-circle"></button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div> -->

    <div class="container">
        <a href="/dashboard/products/create" class="btn btn-primary mb-3">Add Product</a>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2 d-flex justify-content-between" style="background-color:rgba(0, 0, 0, 0.7)"><a href="/products?category={{ $product->category->slug }}" class="text-white text-decoration-none">{{ $product->category->title }}</a></div>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->category->title }}" class="img-fluid">
                    @else
                        <img src="https://source.unsplash.com/500x400?{{ $product->category->title }}" class="card-img-top" alt="{{ $product->category->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">{{ $product->price }}</p>
                    <a href="/dashboard/products/{{ $product->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/products/{{ $product->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure you want to delete this?')"><span data-feather="x-circle"></button>
                    </form>
                    <form action="/dashboard/cart" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->image }}" name="image">
                        <input type="hidden" value="1" name="quantity">
                        <input type="hidden" value="{{ $product->price }}" name="subtotal">
                        <!-- <input type="hidden" value="1" name="quantity"> -->
                        <button type="submit" class="badge bg-info border-0" ><span data-feather="shopping-cart"></button>
                    </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection