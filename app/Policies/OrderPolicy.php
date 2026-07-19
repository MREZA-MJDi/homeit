<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Support']);
    }

    public function view(User $user, Order $order): bool
    {
        if ($user->hasAnyRole(['Super Admin', 'Admin', 'Support'])) {
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

    public function update(User $user, Order $order): bool
    {
        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            return true;
        }

        if ($user->hasRole('Customer')) {
            return $order->customer_id === $user->id
                && $order->status === 'pending';
        }

        return false;
    }

    public function delete(User $user, Order $order): bool
    {
        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            return true;
        }

        return $user->hasRole('Customer')
            && $order->customer_id === $user->id
            && $order->status === 'pending';
    }

    public function assignTechnician(User $user, Order $order): bool
    {
        return $user->hasAnyRole([
                'Super Admin',
                'Admin',
            ]) && $order->isPending();
    }

    public function accept(User $user, Order $order): bool
    {
        return $user->hasRole('Technician')
            && $order->assigned_technician_id === $user->id
            && $order->isAssigned();
    }

    public function onTheWay(User $user, Order $order): bool
    {
        return $user->hasRole('Technician')
            && $order->assigned_technician_id === $user->id
            && $order->isAccepted();
    }

    public function start(User $user, Order $order): bool
    {
        return $user->hasRole('Technician')
            && $order->assigned_technician_id === $user->id
            && $order->isOnTheWay();
    }

    public function complete(User $user, Order $order): bool
    {
        return $user->hasRole('Technician')
            && $order->assigned_technician_id === $user->id
            && $order->isInProgress();
    }

    public function cancel(User $user, Order $order): bool
    {
        if ($user->hasAnyRole([
            'Super Admin',
            'Admin',
        ])) {
            return true;
        }

        if ($user->hasRole('Customer')) {
            return $order->customer_id === $user->id
                && !in_array($order->status, [
                    'completed',
                    'cancelled',
                ]);
        }

        return false;
    }
}
