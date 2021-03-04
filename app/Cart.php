<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'products_id', 'users_id'
    ];

    protected $hidden = [
        
    ];

    public function product() 
    {
        return $this->hasOne(Product::class, 'id', 'products_id'); // karena setiap item cart itu punya 1 product 
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id'); 
    }
}
