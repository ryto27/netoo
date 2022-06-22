@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Table List</h1>
</div>

@if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif

<div class="table-responsive col-lg-8">
    <a href="/dashboard/tables/create" class="btn btn-primary mb-3">Create New table</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col">no</th>
                <th scope="col">status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tables as $table)
            <tr>
                <!-- <td>{{ $loop->iteration }}</td> -->
                <td>{{ $table->number }}</td>
                <td>{{ $table->status }}</td>
                <td>
                    <form action="/dashboard/tables/{{ $table->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure you want to delete this?')"><span data-feather="x-circle"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection