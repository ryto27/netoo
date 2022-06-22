@extends('dashboard.layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                @foreach ($details as $detail)
                <ul>
                    <li>{{ $detail->order->status }}</li>
                    <li>{{ $detail->item }}</li>
                    <li>{{ $detail->quantity }}</li>
                </ul>
                @endforeach
                <a href="/dashboard/orders" class="d-block mt-3 text-decoration-none">Back to posts</a>
            </div>
        </div>
    </div>

@endsection