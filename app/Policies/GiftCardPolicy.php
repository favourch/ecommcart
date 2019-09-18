<?php

namespace App\Policies;

use App\User;
use App\GiftCard;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiftCardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view gift_cards.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_gift_card'))->check();
    }

    /**
     * Determine whether the user can view the GiftCard.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function view(User $user, GiftCard $giftCard)
    {
        return (new Authorize($user, 'view_gift_card', $giftCard))->check();
    }

    /**
     * Determine whether the user can create GiftCards.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_gift_card'))->check();
    }

    /**
     * Determine whether the user can update the GiftCard.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function update(User $user, GiftCard $giftCard)
    {
        return (new Authorize($user, 'edit_gift_card', $giftCard))->check();
    }

    /**
     * Determine whether the user can delete the GiftCard.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function delete(User $user, GiftCard $giftCard)
    {
        return (new Authorize($user, 'delete_gift_card', $giftCard))->check();
    }
}
