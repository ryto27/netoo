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
                  <th>
                    No
                  </th>
                  <th>
                    Nama
                  </th>
                  <th>
                    Harga
                  </th>
                  <th>
                    Qty
                  </th>
                  <th>
                    Subtotal
                  </th>
                </tr>
              </thead>
              <tbody>
              @foreach($itemorder->cart->detail as $detail)
                <tr>
                  <td>
                  {{ $loop->iteration }}
                  </td>
                  <td>
                  {{ $detail->product->name }}
                  </td>
                  <td class="text-right">
                  {{ number_format($detail->harga, 2) }}
                  </td>

                  <td class="text-right">
                  {{ $detail->qty }}
                  </td>
                  <td class="text-right">
                  {{ number_format($detail->subtotal, 2) }}
                  </td>
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
          <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-danger">Tutup</a>
        </div>
      </div>

    </div>
    <div class="col col-lg-4 col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ringkasan</h3>
        </div>
        <div class="card-body">
          @if(count($errors) > 0)
          @foreach($errors->all() as $error)
              <div class="alert alert-warning">{{ $error }}</div>
          @endforeach
          @endif
          @if ($message = Session::get('error'))
              <div class="alert alert-warning">
                  <p>{{ $message }}</p>
              </div>
          @endif
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <div class="table-responsive">
            <table class="table">
              <form action="{{ route('transaksi.update', $itemorder->id) }}" method='post'>
              @csrf
              {{ method_field('patch') }}
              <tbody>
                <tr>
                  <td>
                    Total
                  </td>
                  <td>
                    <input type="text" name="total" id="total" class="form-control" value="{{ $itemorder->cart->total }}">
                  </td>
                </tr>
                <tr>
                  <td>
                    Subtotal
                  </td>
                  <td>
                  <input type="text" name="subtotal" id="subtotal" class="form-control" value="{{ $itemorder->cart->subtotal }}">
                  </td>
                </tr>
                <tr>
                  <td>
                    Status Pembayaran
                  </td>
                  <td>
                    <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                      <option value="sudah" {{ $itemorder->cart->status_pembayaran == 'sudah' ? 'selected':'' }}>Sudah Dibayar</option>
                      <option value="belum" {{ $itemorder->cart->status_pembayaran == 'belum' ? 'selected':'' }}>Belum Dibayar</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    Status Order
                  </td>
                  <td>
                    <select name="status_pengiriman" id="status_pengiriman" class="form-control">
                      <option value="sudah" {{ $itemorder->cart->status_pengiriman == 'sudah' ? 'selected':'' }}>Sudah</option>
                      <option value="belum" {{ $itemorder->cart->status_pengiriman == 'belum' ? 'selected':'' }}>Belum</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </td>
                </tr>
              </tbody>
              </form>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection