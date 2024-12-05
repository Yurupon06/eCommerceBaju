<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'order_date',
        'total_amount',
        'status',
    ];

    public function customer(){
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Add this boot method to handle cascading deletes
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($order) {
            $order->orderDetails()->delete();
        });
    }

}
