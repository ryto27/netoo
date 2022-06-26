@extends('dashboard.layouts.main')

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
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class=" px-3 py-2 d-flex justify-content-center" style="background-color:rgba(0, 0, 0, 0.7)">
                    <a class="text-white text-decoration-none">Table</a>
                </div>

                    <div class="card-body">
                    <table class="table table-responsive">
                    <tr>
                            <td>Status</td>
                            <td class="text-center">:</td>
                            <td class="text-center">{{ $order->cart->status_cart }}</td>
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
                        <tr>
                            <td>
                                <form action="/orders/{{ $order->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete this?')">Cancel</button>
                                </form>
                            </td>
                            <td></td>
                            <td></td>
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