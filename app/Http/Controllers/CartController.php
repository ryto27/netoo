<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

class CartController extends Controller
{
    public function index()
    {

        return view( '/cart',[
            'active' => 'cart',
            'title' => 'cart',
            'itemcart' => Cart::where('user_id', auth()->user()->id)->get()
            ->where('status_cart', 'cart')
            ->first()
        ]);
    }


    public function store(Request $request)
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(Cart $cart)
    {
        //
    }

    public function kosongkan($id) {
        $itemcart = Cart::findOrFail($id);
        $itemcart->detail()->delete();//hapus semua item di cart detail
        $itemcart->updatetotal($itemcart, '-'.$itemcart->total_qty, '-'.$itemcart->total);
        return back()->with('success', 'Cart berhasil dikosongkan');
    }

    public function checkout(Request $request) {
        $itemuser = $request->user();
        $itemcart = Cart::where('user_id', $itemuser->id)
                        ->where('status_cart', 'cart')
                        ->first();

        $status['status_cart'] = 'checkout';
        Cart::where('user_id', $itemuser->id)->update($status);

        $order['user_id'] = $itemuser->id;
        $order['cart_id'] = $itemcart->id;
        Order::create($order);

        return redirect('orders')->with('success', 'Order berhasil dibuat!');

    }
}