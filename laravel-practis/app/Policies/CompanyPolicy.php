<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

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

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return $user->company->id === $company->id;
    }
}
