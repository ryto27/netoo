<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;


class CartController extends Controller
{
    public function index()
    {
        return view( '/cart',[
            'active' => 'cart',
            'title' => 'cart',
            'cart' => Cart::where('user_id', auth()->user()->id)->get()
        ]);
    }


    public function store(Request $request)
    {

            $validatedData = $request->validate([
                'product_id' => 'required',
                'name' => 'required','max:255',
                'price' => 'required','max:100',
                'quantity' => 'required',
                'subtotal' => 'required',
                'image' => 'nullable', //max 10MB
            ]);

            $validatedData['user_id'] = auth()->user()->id;
            Cart::create($validatedData);
            return redirect('/products')->with('success', 'Added to cart!');
    }

    public function update(Request $request, $id)
    {
        $itemdetail = Cart::findOrFail($id);
        $param = $request->param;
        
        if ($param == 'tambah') {
            // update cart
            $qty = 1;
            $itemdetail->updatejumlah($itemdetail, $qty, $itemdetail->price);
            return back()->with('success');
        }

        if ($param == 'kurang') {
            // update cart
            $qty = 1;
            $itemdetail->updatejumlah($itemdetail, '-'.$qty, $itemdetail->price);
            return back()->with('success');
        }

    }

    public function destroy(Cart $cart)
    {

        Cart::destroy($cart->id);
        
        return redirect('/cart')->with('success', 'item has been removed.');
    }

    public function kosongkan($id) {
        $itemcart = Cart::findOrFail($id);
        $itemcart->cart()->delete();//hapus semua item di cart detail
        return back()->with('success', 'Cart berhasil dikosongkan');
    }
}