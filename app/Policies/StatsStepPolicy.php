<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visit;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class StatsStepPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return true;
    }
    public function viewAny(User $user)
    {
        return true;
        //
        // if ($user !== null) {
        //     return true;
        // }
    }

}
