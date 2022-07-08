<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemuser = auth()->user();
        if ($itemuser->role == 'admin') {
            // kalo admin maka menampilkan semua cart
            $itemorder = Order::whereHas('cart', function($q) use ($itemuser) {
                            $q->where('status_cart', 'checkout');
                        })
                        ->latest()
                        ->get();
            $data = array('title' => 'My Order',
                    'active' => 'orders',
                    'itemorder' => $itemorder,
                );
        } else {
            // kalo member maka menampilkan cart punyanya sendiri
            $itemorder = Order::whereHas('cart', function($q) use ($itemuser) {
                            $q->where('status_cart', 'checkout');
                            $q->where('user_id', $itemuser->id);
                        })
                        ->latest()
                        ->get();
            $data = array('title' => 'My Order',
                'active' => 'orders',
                'itemorder' => $itemorder,
                );
        }
        return view('orders', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //ambil id cart dengan foreign cart_id pada order
        $cart = Cart::where('id', $order->cart_id)->get();
        //delete cart
        Cart::destroy($cart);
        //delete order
        Order::destroy($order->id);
        
        return redirect('/orders')->with('success', 'item has been removed.');
    }
}
