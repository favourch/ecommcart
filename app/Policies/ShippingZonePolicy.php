<?php

namespace App\Policies;

use App\User;
use App\ShippingZone;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShippingZonePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view shipping_zones.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_shipping_zone'))->check();
    }

    /**
     * Determine whether the user can view the shipping_zone.
     *
     * @param  \App\User  $user
     * @param  \App\ShippingZone  $shipping_zone
     * @return mixed
     */
    public function view(User $user, ShippingZone $shipping_zone)
    {
        return (new Authorize($user, 'view_shipping_zone', $shipping_zone))->check();
    }

    /**
     * Determine whether the user can create shipping_zones.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_shipping_zone'))->check();
    }

    /**
     * Determine whether the user can update the shipping_zone.
     *
     * @param  \App\User  $user
     * @param  \App\ShippingZone  $shipping_zone
     * @return mixed
     */
    public function update(User $user, ShippingZone $shipping_zone)
    {
        return (new Authorize($user, 'edit_shipping_zone', $shipping_zone))->check();
    }

    /**
     * Determine whether the user can delete the shipping_zone.
     *
     * @param  \App\User  $user
     * @param  \App\ShippingZone  $shipping_zone
     * @return mixed
     */
    public function delete(User $user, ShippingZone $shipping_zone)
    {
        return (new Authorize($user, 'delete_shipping_zone', $shipping_zone))->check();
    }
}
