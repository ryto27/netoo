@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Product</h1>
</div>

<div class="col-lg-8">
    <form action="/dashboard/products" method="post" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
                @foreach($categories as $category)
                    @if( old('category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                    @else
                    <option value="{{ $category->id }}" >{{ $category->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <img class="img-fluid mb-3 col-sm-5" id="preview">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(event)">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
            <trix-editor input="description"></trix-editor>
            @error('description')
            <p class="text-danger">
                {{ $message }}
            </p>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>

<script>
    const name=document.querySelector('#name');

    document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
    });

    var previewImage = function(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = function() {
        URL.revokeObjectURL(preview.src) // free memory
        }
    };

</script>

@endsection