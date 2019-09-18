<?php

namespace App\Policies;

use App\User;
use App\Faq;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view Faqs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_utility'))->check();
    }

    /**
     * Determine whether the user can view the Faq.
     *
     * @param  \App\User  $user
     * @param  \App\Faq  $faq
     * @return mixed
     */
    public function view(User $user, Faq $faq)
    {
        return (new Authorize($user, 'view_utility', $faq))->check();
    }

    /**
     * Determine whether the user can create Faqs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_utility'))->check();
    }

    /**
     * Determine whether the user can update the Faq.
     *
     * @param  \App\User  $user
     * @param  \App\Faq  $faq
     * @return mixed
     */
    public function update(User $user, Faq $faq)
    {
        return (new Authorize($user, 'edit_utility', $faq))->check();
    }

    /**
     * Determine whether the user can delete the Faq.
     *
     * @param  \App\User  $user
     * @param  \App\Faq  $faq
     * @return mixed
     */
    public function delete(User $user, Faq $faq)
    {
        return (new Authorize($user, 'delete_utility', $faq))->check();
    }
}
