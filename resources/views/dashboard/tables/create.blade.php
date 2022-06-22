@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Table</h1>
</div>

<div class="col-lg-8">
    <form action="/dashboard/tables" method="post" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="number" class="form-label">No</label>
            <input type="number" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}" required>
            @error('number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <input type="hidden" id="status" name="status" value="vacant">




        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>


@endsection