<?php

namespace App\Policies;

use App\Models\Deplacement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class DeplacementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

        return $user->is_admin ;

    }

    public function view(User $user)
    {
        return $user->is_admin;
    }

    public function create(User $user)
    {
        Log::info($user);
        return $user->is_admin;
    }

    public function update(Deplacement $deplacement)
    {
        return !$deplacement->valider;
    }

    public function delete(Deplacement $deplacement)
    {
        Log::info($deplacement);
        return !$deplacement->valider;
    }
}
