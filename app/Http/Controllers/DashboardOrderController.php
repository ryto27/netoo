<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;


use Illuminate\Http\Request;

class DashboardOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'dashboard.orders.index',[
            
            'orders' => Order::all(),
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
        $validatedData = $request->validate([
            'cart_id' => 'required',
            'status' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        Order::create($validatedData);
        // return redirect('/cart')->with('success', 'Order created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('dashboard.orders.show', [
            'details' => OrderDetail::where('order_id', $order->id)->get()
        ]);
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
        $rules =[
            'status' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Order::where('id', $order->id)->update($validatedData);

        return redirect('/dashboard/orders')->with('success', 'Order has been confirmed!');
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
        
        return redirect('/dashboard/orders')->with('success', 'item has been removed.');
    }
}
