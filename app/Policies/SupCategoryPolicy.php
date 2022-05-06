<?php

namespace App\Policies;

use App\Models\SupCategory;
use App\Models\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return $user->hasPermissionTo('Read-SupCategories')
        ? $this->allow()
        : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupCategory  $supCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SupCategory $supCategory)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)

    {
        return $admin->hasPermissionTo('Create-SupCategory')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupCategory  $supCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, SupCategory $supCategory)
    {
        return $admin->hasPermissionTo('Update-SupCategory')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupCategory  $supCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, SupCategory $supCategory)
    {
        return $admin->hasPermissionTo('Delete-SupCategory')
            ? $this->allow()
            : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupCategory  $supCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SupCategory $supCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SupCategory  $supCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SupCategory $supCategory)
    {
        //
    }
}
