<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id']; //apa yang tidak boleh diisi
    protected $with = ['category'];

    public function user() 
    { 
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category() 
    { 
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function getRouteKeyName()
    {
    return 'id';
    }

}
