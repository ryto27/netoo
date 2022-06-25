<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;


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
        $title = '';

        return view( '/orders',[
            "title" => "My Order" . $title,
            "active" => "orders",
            'orders' => Order::where( 'user_id', auth()->user()->id)->get()
        ]);
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
        $dataOrder = $request->validate([
            'cart_id' => 'required',
            'table' => 'required',
            'list' => 'required',
            'status' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $dataOrder['user_id'] = auth()->user()->id;
        Order::create($dataOrder);

        $dataDetail = $request->validate([
            'order_id' => 'required',
            'item' => 'required',
            'quantity' => 'required',
        ]);
        OrderDetail::create($dataDetail);

        return redirect('/orders')->with('success', 'Order created!');
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
        Order::destroy($order->id);
        
        return redirect('/orders')->with('success', 'item has been removed.');
    }
}
