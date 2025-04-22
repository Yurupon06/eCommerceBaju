<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_category_id',
        'product_name',
        'description',
        'price',
        'stok_quantity',
        'image1_url',
        'image2_url',
        'image3_url',
    ];

    public function category(){
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }
    public function discount(){
        return $this->hasOne(Discount::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class);
}




}
