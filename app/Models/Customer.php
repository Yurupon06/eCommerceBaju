<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Customer extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'alamat1',
        'alamat2',
        'alamat3',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

}