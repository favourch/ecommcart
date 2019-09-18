<?php

namespace App\Policies;

use App\User;
use App\Ticket;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view ticketes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_ticket'))->check();
    }

    /**
     * Determine whether the user can view the Ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        return (new Authorize($user, 'view_ticket', $ticket))->check();
    }

    /**
     * Determine whether the user can update the Ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {
        if (!$user->isFromPlatform()) return false;

        return (new Authorize($user, 'update_ticket', $ticket))->check();
    }

    /**
     * Determine whether the user can reply the Ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function reply(User $user, Ticket $ticket)
    {
        return (new Authorize($user, 'reply_ticket', $ticket))->check();
    }

    /**
     * Determine whether the user can assign the Ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function assign(User $user, Ticket $ticket)
    {
        if (!$user->isFromPlatform()) return false;

        return (new Authorize($user, 'assign_ticket', $ticket))->check();
    }
}
