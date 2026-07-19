<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\User;

class OrderItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin']);
    }

    public function view(User $user, OrderItem $orderItem): bool
    {
        $order = $orderItem->order;

        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            return true;
        }

        if ($user->hasRole('Customer')) {
            return $order->customer_id === $user->id;
        }

        if ($user->hasRole('Technician')) {
            return $order->assigned_technician_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Customer');
    }

    public function update(User $user, OrderItem $orderItem): bool
    {
        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            return true;
        }

        return $user->hasRole('Customer')
            && $orderItem->order->status === 'pending'
            && $orderItem->order->customer_id === $user->id;
    }

    public function delete(User $user, OrderItem $orderItem): bool
    {
        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            return true;
        }

        return $user->hasRole('Customer')
            && $orderItem->order->status === 'pending'
            && $orderItem->order->customer_id === $user->id;
    }
}
