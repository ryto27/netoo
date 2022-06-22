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
                        <img src="{{ asset('storage/product-images/no-image.jpg') }}" class="img-fluid" alt="{{ $product->category->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Rp. {{ $product->price }},-</p>
                    <a href="/dashboard/products/{{ $product->id }}/edit">
                        <button type="submit" class="btn btn-sm btn-warning mb-2">Edit</button>                      
                    </a>
                    <form action="/dashboard/products/{{ $product->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger mb-2">Hapus</button>                      
                    </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection