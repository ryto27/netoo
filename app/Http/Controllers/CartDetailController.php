<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->validate([
            'product_id' => 'required'
        ]);

        $itemuser = auth()->user();//ambil data user
        $itemproduct = Product::findOrFail($request->product_id);

        // cek dulu apakah sudah ada shopping cart untuk user yang sedang login
        $cart = Cart::where('user_id', $itemuser->id)->get()
                    ->where('status_cart', 'cart')
                    ->first();
        
        if ($cart) {
            $itemcart = $cart;
        } else {
            $data['user_id'] = $itemuser->id;
            $data['status_cart'] = 'cart';
            $data['status_pembayaran'] = 'belum';
            $itemcart = Cart::create($data);
        }
        // cek dulu apakah sudah ada produk di shopping cart
        $cekdetail = CartDetail::where('cart_id', $itemcart->id)->get()
                                ->where('product_id', $itemproduct->id)
                                ->first();
        $qty = 1;// diisi 1, karena kita set ordernya 1
        $harga = $itemproduct->price;//ambil harga produk
        $subtotal = $qty * $harga;

        if ($cekdetail) {
            // update detail di table cart_detail
            $cekdetail->updatedetail($cekdetail, $qty, $harga);
            // update subtotal dan total di table cart
            $cekdetail->cart->updatetotal($cekdetail->cart, $subtotal);
        } else {
            $inputan = $request->all();
            $inputan['cart_id'] = $itemcart->id;
            $inputan['produk_id'] = $itemproduct->id;
            $inputan['qty'] = $qty;
            $inputan['harga'] = $harga;
            $inputan['subtotal'] = $harga * $qty;
            $itemdetail = CartDetail::create($inputan);
            // update subtotal dan total di table cart
            $itemdetail->cart->updatetotal($itemdetail->cart, $subtotal);
        }
        return back()->with('success', 'Produk berhasil ditambahkan ke cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartDetail  $cartDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CartDetail $cartDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartDetail  $cartDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CartDetail $cartDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartDetail  $cartDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itemdetail = CartDetail::findOrFail($id);
        $param = $request->param;
        
        if ($param == 'tambah') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga);
            // update total cart
            $itemdetail->cart->updatetotal($itemdetail->cart, $itemdetail->harga);
            return back()->with('success', 'Item berhasil diupdate');
        }
        if ($param == 'kurang') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, '-'.$qty, $itemdetail->harga);
            // update total cart
            $itemdetail->cart->updatetotal($itemdetail->cart, '-'. $itemdetail->harga);
            return back()->with('success', 'Item berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartDetail  $cartDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemdetail = CartDetail::findOrFail($id);
        // update total cart dulu
        $itemdetail->cart->updatetotal($itemdetail->cart, '-'.$itemdetail->subtotal);

        if ($itemdetail->delete()) {
            return back()->with('success', 'Item berhasil dihapus');
        } else {
            return back()->with('error', 'Item gagal dihapus');
        }        
    }
    
}
