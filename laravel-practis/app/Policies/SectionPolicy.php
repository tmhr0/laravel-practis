<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can index the model.
     */
    public function index(User $user, Company $company): bool
    {
        return $user->company->id === $company->id;
    }

    /**
     * Determine whether the user can create the model.
     */
    public function create(User $user, Company $company): bool
    {
        return $user->company->id === $company->id;
    }

    /**
     * Determine whether the user can store the model.
     */
    public function store(User $user, Company $company): bool
    {
        return $user->company->id === $company->id;
    }

    /**
     * Determine whether the user can show the model.
     */
    public function show(User $user, Company $company): bool
    {
        return $user->company->id === $company->id;
    }

    /**
     * Determine whether the user can edit the model.
     */
    public function edit(User $user, Company $company): bool
    {
        return $user->company->id === $company->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Company $company): bool
    {
        return $user->company->id === $company->id;
    }
}
