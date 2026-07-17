<?php

namespace App\Policies;

use App\Models\TechnicianProfile;
use App\Models\User;

class TechnicianProfilePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    public function view(User $user, TechnicianProfile $profile): bool
    {
        return $user->hasRole('Admin')
            || $user->id === $profile->user_id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Technician');
    }

    public function update(User $user, TechnicianProfile $profile): bool
    {
        return $user->hasRole('Admin')
            || $user->id === $profile->user_id;
    }

    public function delete(User $user, TechnicianProfile $profile): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, TechnicianProfile $profile): bool
    {
        return false;
    }

    public function forceDelete(User $user, TechnicianProfile $profile): bool
    {
        return false;
    }
}
