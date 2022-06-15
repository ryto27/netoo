<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

        public function posts()
        {
            return $this->hasMany(Post::class);
        }

        public function products()
        {
            return $this->hasMany(Product::class);
        }

        public function users()
        {
            return $this->belongsTo(User::class);
        }
        
        public function getRouteKeyName()
        {
            return 'slug';
        }

        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }
}
