@extends('layouts.main')

@section('container')


    <h1 class="mb-5 text-center">{{ $title }}</h1>


    @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif

@if ( $orders->count() )

<div class="container">
        <div class="row">
            @foreach ($orders as $order)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class=" px-3 py-2 d-flex justify-content-center" style="background-color:rgba(0, 0, 0, 0.7)">
                    <a class="text-white text-decoration-none">Table {{ $order->table }}</a>
                </div>

                    <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <td>Items</td>
                            <td>:</td>
                            <td>{{ $order->list }}</td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>:</td>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <td>
                            <form action="/orders/{{ $order->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete this?')">Delete   </button>                        </form>
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@else
    <p class="text-center fs-4"> No order found.</p>
@endif



@endsection