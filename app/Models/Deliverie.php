<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverie extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'shipping_date',
        'tracking_code',
        'status',
        'foto_kurir',
    ];
    
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
