@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>My cart</h1>
</div>

@if(session()->has('success'))
<div class="d-flex justify-content-center alert alert-success" role="alert">
    {{ session('success') }}
            </div>
@endif
@if ($itemcart && $itemcart->detail->count())
<div class="container">
    <div class="row">
    <div class="table-responsive col-lg-8">

        <div class="card mb-3">
        <div class="card-header">
            Item
        </div>
        <div class="card-body">
        <table class="table table-stripped table-sm">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Product</th>
                <th scope="col">Harga</th>
                <th scope="col">Qty</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Action</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($itemcart->detail as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product->name }}</td>
                <td>{{ number_format($detail->harga, 2) }}</td>
                <td>
                    <div class="btn-group" role="group">
                    <form action="{{ route('cartdetail.update',$detail->id) }}" method="post" >
                    @method('patch')
                    @csrf()
                        <input type="hidden" name="param" value="kurang">
                        <button class="btn btn-primary btn-sm">
                        -
                        </button>
                    </form>
                    <button class="btn btn-outline-primary btn-sm" disabled="true">
                        {{ $detail->qty }}
                    </button>
                    <form action="{{ route('cartdetail.update',$detail->id) }}" method="post">
                    @method('patch')
                    @csrf()
                        <input type="hidden" name="param" value="tambah">
                        <button class="btn btn-primary btn-sm">
                        +
                        </button>
                    </form>
                    </div>
                </td>
                <td>{{ number_format($detail->subtotal, 2) }}</td>
                <td>
                    <form action="{{ route('cartdetail.destroy', $detail->id) }}" method="post" style="display:inline;">                    @method('delete')
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
    <div class="col">
        <div class="card">
            <div class="card-header">
                Ringkasan
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                <tr>
                    <td>Total Qty</td>
                    <td>:</td>
                    <td class="text-right">
                    {{ $itemcart->total_qty }}
                    </td>
                </tr>

                <tr>
                    <td>Total</td>
                    <td>:</td>
                    <td class="text-right">
                    {{ number_format($itemcart->total, 2) }}
                    </td>
                </tr>
                </table>
            </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-around">
                    <form action="/checkout/{{ $itemcart->id }}" method="post">
                    @csrf
                    @method('patch')
                        <button class="btn btn-primary btn-block">Checkout</button>
                    </form>
                    <form action="/kosongkan/{{ $itemcart->id }}" method="post">
                    @csrf
                    @method('patch')
                        <button type="submit" class="btn btn-danger btn-block">Kosongkan</button>
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