<?php

namespace App\Helpers;

use Auth;
use App\Permission;

/**
* Check the action athentications
*/
class Authorize
{
	protected $user;

	protected $model;

	protected $slug;

	function __construct($user, $slug, $model = Null)
	{
		$this->user = $user;
		$this->model = $model;
		$this->slug = $slug;
	}

	/**
	 * Check authorization
	 *
	 * @return boolean
	 */
	public function check()
	{
		// return true; //FOR TEMPORARY TEST
		if($this->isExceptional())
			return true;

		// echo "<pre>"; print_r($this->permissionSlugs()); echo "</pre>"; exit();
		// Deny the action immediately if the model has shop_id field and user from different shop
		if(isset($this->model)
		   	&& (isset($this->model->shop_id) || array_key_exists('shop_id', $this->model))
		    && ! Auth::user()->isFromPlatform()
		    && ! $this->merchantAuth())
		{
			return false;
		}

        return in_array($this->slug, $this->permissionSlugs());
	}

	/**
	 * Check if the user's shop_id and model's shop_id is same
	 *
	 * @return boolean
	 */
	private function merchantAuth()
	{
		return isset($this->model->shop_id) && $this->model->shop_id == $this->user->merchantId();
	}

	/**
	 * Some case in special conditions you may allow all actions for the user
	 *
	 * @return boolean
	 */
	private function isExceptional()
	{
		// Some routes only shows personalized information and allow access
        if(in_array($this->slug, ['dashboard', 'profile', 'secretLogout']))
            return true;

		// The Super admin will not required to check authorization.
		if(Auth::user()->isSuperAdmin()){
			// Just avoid the merchant modules to keep the dashboard clean
			if (isset(config('authSlugs')[$this->slug]))
				return config('authSlugs')[$this->slug] != 'Merchant';

			return true;
		}

		// The content creator always have the full permission
		if(isset($this->model->user_id) && $this->model->user_id == $this->user->id)
			return true;

		return false;
	}

	/**
	 * If the logged in user is the same user to check the authorization,
	 * then return permission from config veriable that sets by the initSettings middleware.
	 * Otherwise get the permission from the database.
	 *
	 * @return arr
	 */
	private function permissionSlugs()
	{
		// For current user just return permissions from cinfig
		if( Auth::guard('web')->user()->id == $this->user->id )
	        return config('permissions');

        return $this->user->role->permissions()->pluck('slug')->toArray();
	}
}