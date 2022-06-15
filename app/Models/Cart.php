<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $guarded = ['id'];

    public function user() 
    { 
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function product() 
    {
        return $this->hasMany(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function updatejumlah($itemdetail, $quantity, $price) {
        $this->attributes['quantity'] = $itemdetail->quantity + $quantity;
        $this->attributes['subtotal'] = $itemdetail->subtotal + ($quantity * $price);
        self::save();
    }

    public function updatetotal($itemcart, $subtotal) {
        $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
        $this->attributes['total'] = $itemcart->total + $subtotal;
        self::save();
    }


}
