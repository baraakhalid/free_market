<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
        return $user->hasPermissionTo('Read-Categories')
        ? $this->allow()
        : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Category $category)
    {
        return $user->hasPermissionTo('Read-Categories')|| auth('user')->check() 
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('Create-Category')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Category $category)
    {
        return $admin->hasPermissionTo('Update-Category')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Category $category)
    {
        return $admin->hasPermissionTo('Delete-Category')
            ? $this->allow()
            : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
