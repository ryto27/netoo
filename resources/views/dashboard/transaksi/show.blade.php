@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col col-lg-8 col-md-8 mb-2">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Item</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($itemorder->cart->detail as $detail)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $detail->product->name }}</td>
                  <td class="text-right">{{ number_format($detail->harga, 2) }}</td>
                  <td class="text-right">{{ $detail->qty }}</td>
                  <td class="text-right">{{ number_format($detail->subtotal, 2) }}</td>
                </tr>
                @endforeach

                <tr>
                  
                  <td colspan="3"><strong>Total</strong></td>
                  <td><strong>{{ $itemorder->cart->total_qty }}</strong></td>
                  <td class="text-right"><strong>{{ number_format($itemorder->cart->total, 2) }}</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <a href="/dashboard/transaksi/" class="btn btn-sm btn-danger">Tutup</a>
          <a href="/dashboard/transaksi/{{$itemorder->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
        </div>
      </div>
    </div>
    <div class="col col-lg-4 col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ringkasan</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>Total Qty</td>
                  <td class="text-right">{{ $itemorder->cart->total_qty }}</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td class="text-right">{{ number_format($itemorder->cart->total, 2) }}</td>
                </tr>
                <tr>
                  <td>Status Pembayaran</td>
                  <td class="text-right">{{ $itemorder->cart->status_pembayaran }}</td>
                </tr>
                <tr>
                  <td>Status Order/td>
                  <td>belum</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  @endsection