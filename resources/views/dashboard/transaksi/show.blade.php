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
            <table class="table">
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
                  <td colspan="6">
                    <b>Total</b>
                  </td>
                  <td class="text-right">
                    <b>
                    {{ number_format($itemorder->cart->total, 2) }}
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <a href="/dashboard/transaksi/" class="btn btn-sm btn-danger">Tutup</a>
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
                  <td>
                    Total
                  </td>
                  <td class="text-right">
                    {{ number_format($itemorder->cart->total, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    Subtotal
                  </td>
                  <td class="text-right">
                  {{ number_format($itemorder->cart->subtotal, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    Diskon
                  </td>
                  <td class="text-right">
                  {{ number_format($itemorder->cart->diskon, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    Ongkir
                  </td>
                  <td class="text-right">
                  {{ number_format($itemorder->cart->ongkir, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    Ekspedisi
                  </td>
                  <td class="text-right">
                  {{ number_format($itemorder->cart->ekspedisi, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    No. Resi
                  </td>
                  <td class="text-right">
                  {{ number_format($itemorder->cart->no_resi, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    Status Pembayaran
                  </td>
                  <td class="text-right">
                  {{ $itemorder->cart->status_pembayaran }}
                  </td>
                </tr>
                <tr>
                  <td>
                    Status Pengiriman
                  </td>
                  <td class="text-right">
                  {{ $itemorder->cart->status_pengiriman }}
                  </td>
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