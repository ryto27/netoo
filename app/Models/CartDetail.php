<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // function untuk update qty, sama subtotal
    public function updatedetail($itemdetail, $qty, $harga) {
        $this->attributes['qty'] = $itemdetail->qty + $qty;
        $this->attributes['subtotal'] = $itemdetail->subtotal + ($qty * $harga);
        self::save();
    }
}
