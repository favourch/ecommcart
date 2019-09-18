<?php

namespace App\Policies;

use App\User;
use App\Category;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view categorys.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_category'))->check();
    }

    /**
     * Determine whether the user can view the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        return (new Authorize($user, 'view_category', $category))->check();
    }

    /**
     * Determine whether the user can create Categorys.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_category'))->check();
    }

    /**
     * Determine whether the user can update the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        return (new Authorize($user, 'edit_category', $category))->check();
    }

    /**
     * Determine whether the user can delete the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        return (new Authorize($user, 'delete_category', $category))->check();
    }
}
