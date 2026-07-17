<?php

namespace App\Policies;

use App\Models\TechnicianService;
use App\Models\User;

class TechnicianServicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Admin')
            || $user->hasRole('Technician');
    }

    public function view(User $user, TechnicianService $service): bool
    {
        return $user->hasRole('Admin')
            || $user->id === $service->technician_id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Technician');
    }

    public function update(User $user, TechnicianService $service): bool
    {
        return $user->hasRole('Admin')
            || $user->id === $service->technician_id;
    }

    public function delete(User $user, TechnicianService $service): bool
    {
        return $user->hasRole('Admin')
            || $user->id === $service->technician_id;
    }

    public function restore(User $user, TechnicianService $service): bool
    {
        return false;
    }

    public function forceDelete(User $user, TechnicianService $service): bool
    {
        return false;
    }
}
