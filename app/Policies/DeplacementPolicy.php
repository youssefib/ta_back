<?php

namespace App\Policies;

use App\Models\Deplacement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeplacementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user, Deplacement $deplacement)
    {
        return $user->is_admin || $deplacement->user->id === $user->id;
    }

    public function view(User $user, Deplacement $deplacement)
    {
        return $user->is_admin || $deplacement->user->id === $user->id;
    }

    public function create(User $user, Deplacement $deplacement)
    {
        return $user->is_admin || $deplacement->user->id === $user->id;
    }

    public function update(User $user, Deplacement $deplacement)
    {
        return $user->is_admin || $deplacement->user->id === $user->id;
    }

    public function delete(User $user, Deplacement $deplacement)
    {
        return $user->is_admin;
    }
}
