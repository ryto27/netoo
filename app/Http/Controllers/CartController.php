<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;


class CartController extends Controller
{
    public function index()
    {
        // return view( '/cart',[
        //     'active' => 'cart',
        //     'title' => 'cart',
        //     'cart' => Cart::where('user_id', auth()->user()->id)->get()
        // ]);

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
        $itemcart->updatetotal($itemcart, '-'.$itemcart->subtotal);
        return back()->with('success', 'Cart berhasil dikosongkan');
    }
}