<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'customer_id',
        'assigned_technician_id',
        'assigned_by',
        'address_id',

        'status',

        'subtotal',
        'discount_amount',
        'total_price',

        'currency',

        'payment_status',

        'requested_at',
        'assigned_at',
        'accepted_at',
        'started_at',
        'completed_at',
        'cancelled_at',

        'cancelled_by',

        'cancel_reason',

        'customer_note',

    ];

    protected $casts = [

        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_price' => 'decimal:2',

        'requested_at' => 'datetime',
        'assigned_at' => 'datetime',
        'accepted_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function address()
    {
        return $this->belongsTo(Address::class);

    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'assigned_technician_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }


    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isAssigned(): bool
    {
        return $this->status === 'assigned';
    }

    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isOnTheWay(): bool
    {
        return $this->status === 'on_the_way';
    }
}
