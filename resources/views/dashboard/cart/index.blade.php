@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My carts</h1>
</div>

@if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif

<div class="container">
    <div class="row">
    <div class="col col-md-8">

        <div class="card">
        <div class="card-header">
            Item
        </div>
        <div class="card-body">
        <table class="table table-stripped">
            <thead>
            <tr>
                <th>No</th>
                <th>image</th>
                <th>product</th>
                <th>price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
            <tr>
                <td>
                {{ $loop->iteration }}
                </td>

                <td>
                @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->image }}" class="img-fluid">
                    @else
                        <img src="https://source.unsplash.com/150x100?{{ $item->name }}" class="card-img-top" alt="{{ $item->name }}">
                    @endif
                </td>
                <td>
                {{ $item->name }}
                </td>
                <td>
                {{ $item->price }}
                </td>
                <td>
                    <div class="btn-group" role="group">
                    <form action="{{ route('cart.update',$item->id) }}" method="post">
                    @method('patch')
                    @csrf()
                        <input type="hidden" name="param" value="kurang">
                        <button class="btn btn-primary btn-sm">
                        -
                        </button>
                    </form>
                    <button class="btn btn-outline-primary btn-sm" disabled="true">
                        {{ $item->quantity }}
                    </button>
                    <form action="{{ route('cart.update',$item->id) }}" method="post">
                    @method('patch')
                    @csrf()
                        <input type="hidden" name="param" value="tambah">
                        <button class="btn btn-primary btn-sm">
                        +
                        </button>
                    </form>
                    </div>
                </td>
                <td>
                {{ $item->subtotal }}
                </td>
                <td>
                <form action="/dashboard/cart/{{ $item->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger mb-2">
                    Hapus
                    </button>                    
                </form>
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="col col-md-4">
        <div class="card">
        <div class="card-header">
            Ringkasan
        </div>
        <div class="card-body">
            <table class="table">

            <tr>
                <td>Total Qty</td>
                <td class="text-right">
                <!-- Fungsi Hitung Jumlah Barang -->
                <?php
                $jumlah = 0;
                foreach ($cart as $item) {
                    $nilai=$item->quantity;
                    $jumlah = $jumlah + $nilai;
                }
                ?>
                <!-- Tampil Jumlah Quantity -->
                <?php echo($jumlah); ?>
                </td>
            </tr>

            <tr>
                <td>Total</td>

                <td class="text-right">
                <!-- Fungsi Hitung Total -->
                <?php
                $total = 0;
                foreach ($cart as $item) {
                    $nilai=$item->subtotal;
                    $total = $total + $nilai;
                }
                ?>
                <!-- Tampilkan Nilai total -->
                <?php echo($total); ?>
                </td>
            </tr>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
            <div class="col">
            <form action="/dashboard/orders" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="text" value="{{ $item->id }}" name="cart_id">
                <input type="text" value="waiting" name="status">
                <input type="text" value="<?php echo($jumlah); ?>" name="quantity">
                <input type="text" value="<?php echo($total); ?>" name="total">
                <input type="text" value="<?php echo(date("d-M-Y")); ?>" name="date">
                <input type="text" value="<?php echo(date("H:i")); ?>" name="time">

                <button class="btn btn-primary btn-block">Checkout</button>
            </form>
        </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

@endsection