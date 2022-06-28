

@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Transaction</h1>
</div>

@if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Datetime</th>
                <th scope="col">Total Items</th>
                <th scope="col">Total</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itemorder as $order)
            <tr class="align-middle">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->cart->total_qty }}</td>
                <td>{{ number_format($order->cart->total, 2) }}</td>
                <td>{{ $order->cart->status_pembayaran }}</td>
                <td>
                    <a href="{{ route('transaksi.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    <a href="/dashboard/transaksi/{{$order->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection