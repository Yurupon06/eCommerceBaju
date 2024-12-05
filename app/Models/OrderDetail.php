<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'subtotal',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order(){
        return $this->belongsTo(order::class, 'order_id');
    }
}
