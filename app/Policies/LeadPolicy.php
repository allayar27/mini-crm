<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeadPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Lead $lead): bool
    {
        return $lead->assigned_to === $user->id;
    }


    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Lead $lead): bool
    {
        return $lead->assigned_to === $user->id;
    }

    public function delete(User $user, Lead $lead): bool
    {
        return $lead->assigned_to === $user->id;
    }
}
