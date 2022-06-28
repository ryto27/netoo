@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>{{ $title }}</h1>
</div>
    @if(session()->has('success'))
            <div class="d-flex justify-content-center alert alert-success" role="alert">
                {{ session('success') }}
            </div>
@endif

@if ( $itemorder->count() )

<div class="container">
        <div class="row">
@foreach ($itemorder as $order)

<div class="col col-md-4">
    <div class="card">
        <div class="card-header">
            Table
        </div>
        <div class="card-body">
            <table class="table table-responsive">
                <tr>
                    <td>Status Pembayaran</td>
                    <td class="text-center">:</td>
                    <td class="text-center">{{ $order->cart->status_pembayaran }}</td>
                </tr>
                <tr>
                    <td>
                        @foreach ($order->cart->detail as $item)
                        {{ $item->product->name }}<br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($order->cart->detail as $item)
                        :<br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($order->cart->detail as $item)
                        {{ $item->qty }}<br>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td class="text-center">:</td>
                    <td class="text-center">Rp. {{ number_format($order->cart->total) }}.-</td>
                </tr>
            </table>
        </div>
        @if($order->cart->status_pembayaran == 'belum')
            <div class="card-footer">
                    <form action="/orders/{{ $order->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Cancel</button>
                </div>  
        @endif
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