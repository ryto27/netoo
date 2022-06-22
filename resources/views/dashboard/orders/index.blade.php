@extends('dashboard.layouts.main')

@section('container')
<meta http-equiv="refresh" content="10" />
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Order List</h1>
</div>

@if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif

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
                            <td>
                            @foreach ($order->detail as $item)
                            {{ $item->item }}<br>
                            @endforeach
                            </td>
                            <td>
                            @foreach ($order->detail as $item)
                            {{ $item->quantity }}<br>
                            @endforeach
                            </td>
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
                            <form action="/dashboard/orders/{{ $order->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete this?')">Delete   </button>
                            </form>
                            </td>
                            <td>
                            <form action="/dashboard/orders/{{ $order->id }}" method="post" class="d-inline">
                                @method('patch')
                                @csrf
                                <input type="hidden" value="confirmed" name="status" required>
                                <button type="submit" class="btn btn-success mb-3" >Confirm</button>
                            </form>
                            </td>
                            <td>
                                <a href="/dashboard/orders/{{ $order->id }}"><button class="btn btn-info mb-3" >Detail</button></a>
                            </td>

                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection