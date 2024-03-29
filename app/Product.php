<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'name', 'description', 'stock', 'prices','how_to_use', 'ingredients', 'slug'
    ];

    protected $hidden = [
        
    ];

    // public function user(){
    //     return $this->hasOne( User::class, 'id', 'users_id');
    // }

    public function galleries() 
    {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id_product');
    }
}
