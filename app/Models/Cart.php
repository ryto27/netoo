<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() 
    { 
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail() {
        return $this->hasMany(CartDetail::class, 'cart_id');
    }

    public function updatetotal($itemcart, $qty, $subtotal) {
        $this->attributes['total_qty'] = $itemcart->total_qty + $qty;
        $this->attributes['total'] = $itemcart->total + $subtotal;
        self::save();
    }


}
