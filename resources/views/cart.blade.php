@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My cart</h1>
</div>

@if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
@endif
@if ( $cart->count() )
<div class="container">
    <div class="row">
    <div class="table-responsive col-lg-8">

        <div class="card">
        <div class="card-header">
            Item
        </div>
        <div class="card-body">
        <table class="table table-stripped table-sm">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">product</th>
                <th scope="col">price</th>
                <th scope="col">Qty</th>
                <th scope="col">Subtotal</th>
            </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
            <tr>
                <td>
                {{ $loop->iteration }}
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
                <form action="/cart/{{ $item->id }}" method="post" class="d-inline">
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
                <td>No. Meja</td>
                <form action="/orders" method="POST" enctype="multipart/form-data">
                @csrf
                <td>
                    <input type="number" class="form-control @error('table') is-invalid @enderror" id="table" name="table" value="{{ old('table') }}" style="width:70px" required>
                    @error('table')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
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
                $name = '|';
                foreach ($cart as $item) {
                    $nilai=$item->subtotal;
                    $total = $total + $nilai;
                    $name = $name. ' '. $item->name . ' |';   

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
            
                <input type="hidden" value="{{ $item->id }}" name="cart_id">
                <input type="hidden" value="waiting" name="status">
                <input type="hidden" value="<?php echo($name); ?>" name="list">
                <input type="hidden" value="<?php echo($jumlah); ?>" name="quantity">
                <input type="hidden" value="<?php echo($total); ?>" name="total">
                <input type="hidden" value="<?php echo(date("d-M-Y")); ?>" name="date">
                <input type="hidden" value="<?php echo(date("H:i")); ?>" name="time">

                <button class="btn btn-primary btn-block">Checkout</button>
            </form>
        </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@else
    <p class="text-center fs-4">Cart Kosong</p>
@endif

@endsection