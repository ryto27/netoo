<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $itemuser = auth()->user();
        if ($itemuser->role == 'admin') {
            // kalo admin maka menampilkan semua cart
            $itemorder = Cart::where('status_cart', 'checkout')
                                ->get();
        } else {
            // kalo member maka menampilkan cart punyanya sendiri
            $itemorder = Cart::where('user_id', $itemuser->id)
                                ->where('status_cart', 'checkout')
                                ->get();
        }
        $data = array('title' => 'Data Transaksi',
                    'active' => 'transaksi',
                    'itemorder' => $itemorder,
                    'itemuser' => $itemuser);
        return view('dashboard.transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemuser = $request->user();
        $itemcart = Cart::where('status_cart', 'cart')
                        ->where('user_id', $itemuser->id)
                        ->first();
        if ($itemcart) {

                // buat variabel inputan order
                $order['cart_id'] = $itemcart->id;

                $itemorder = Order::create($order);//simpan order
                // update status cart
                $itemcart->update(['status_cart' => 'checkout']);
                return redirect('dashboard.transaksi.index')->with('success', 'Order berhasil disimpan');

        } else {
            return abort('404');//kalo ternyata ga ada shopping cart, maka akan menampilkan error halaman tidak ditemukan
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = array('title' => 'Detail Transaksi');
        return view('dashboard.transaksi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemorder = Order::findOrFail($id);
        $data = array(
            'title' => 'Detail Transaksi',
            'active' => 'transaksi',
            'itemorder' => $itemorder
    );
        return view('dashboard.transaksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
