<?php

namespace App\Common;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on Addresses
 *
 * @author Munna Khan
 */
trait Addressable {

	/**
	 * Check if model has an address.
	 *
	 * @return bool
	 */
	public function hasAddress()
	{
		return (bool) $this->addresses()->count();
	}

	/**
	 * Return any address related to the model model
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function address()
	{
        return $this->addresses->first();
	}

	/**
	 * Return collection of addresses related to the tagged model
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function addresses()
	{
        return $this->morphMany(\App\Address::class, 'addressable');
	}

	/**
	 * Fetch primary address
	 *
	 * @return Address or null
	 */
	public function primaryAddress()
	{
        return $this->morphOne(\App\Address::class, 'addressable')->where('address_type', 'Primary');
	}

	/**
	 * Fetch billing address
	 *
	 * @return Address or null
	 */
	public function billingAddress()
	{
        return $this->morphOne(\App\Address::class, 'addressable')->where('address_type', 'Billing');
	}

	/**
	 * Fetch billing address
	 *
	 * @return Address or null
	 */
	public function shippingAddress()
	{
        return $this->morphOne(\App\Address::class, 'addressable')->where('address_type', 'Shipping');
	}

	/**
	 * Deletes all the addresses of this model.
	 *
	 * @return bool
	 */
	public function flushAddresses()
	{
		return $this->addresses()->delete();
	}
}