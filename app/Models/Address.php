<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_id',
        'label',
        'receiver_name',
        'receiver_mobile',
        'address',
        'plaque',
        'unit',
        'postal_code',
        'is_default',
    ];

    public function casts()
    {
        return [
            'is_default' => 'boolean'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
