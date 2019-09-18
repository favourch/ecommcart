<?php

namespace App\Common;

use Auth;
use App\Helpers\Authorize;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on Addresses
 *
 * @author Munna Khan
 */
trait Authorizable
{
    private $abilities = [
        'index'             => 'view',
        'show'              => 'view',
        'view'              => 'view',
        'staffs'            => 'view',
        'entities'          => 'view',
        'labelOf'           => 'view',
        'statusOf'          => 'view',
        'general'           => 'view',
        'create'            => 'add',
        'add'               => 'add',
        'store'             => 'add',
        'draftSend'         => 'add',
        'find'              => 'add',
        'addWithVariant'    => 'add',
        'storeWithVariant'  => 'add',
        'showSearchForm'    => 'add',
        'search'            => 'add',
        'restore'           => 'add',
        'fulfill'           => 'fulfill',
        'updateOrderStatus' => 'fulfill',
        'togglePaymentStatus'=> 'fulfill',
        'initiate'          => 'initiate',
        'form'              => 'initiate',
        'approve'           => 'approve',
        'decline'           => 'approve',
        'storeReply'        => 'reply',
        'response'          => 'response',
        'storeResponse'     => 'response',
        'edit'              => 'edit',
        'update'            => 'edit',
        'massUpdate'        => 'edit',
        'removeCountry'     => 'edit',
        'editStates'        => 'edit',
        'updateStates'      => 'edit',
        'updateQtt'         => 'edit',
        'delete'            => 'delete',
        'trash'             => 'delete',
        'archive'           => 'archive',
        'destroy'           => 'delete',
        'massDestroy'       => 'delete',
        'secretLogin'       => 'login'
    ];

    /**
     * List of modules that grouped into a common module named vendor modules
     * This will help to set the role permissions
     *
     * @var arr
     */
    private $vendor_modules = [
        'shop',
        'merchant',
    ];

    /**
     * List of modules that grouped into a common module named utility modules
     * This will help to set the role permissions
     *
     * @var arr
     */
    private $utility_modules = [
        'faq',
        'faqTopic',
        'orderStatus',
        'currency',
        'blog',
        'page'
    ];

    /**
     * List of modules that grouped into a common module named apprearance modules
     * This will help to set the role permissions
     *
     * @var arr
     */
    private $appearance_modules = [
        'theme',
        'banner',
        'slider',
    ];

    /**
     * List of modules that has exceptional permission than the abilities above
     * This will help to set the role permissions
     *
     * @var arr
     */
    private $update_exception_modules = [
        'message',
        'ticket',
        'refund'
    ];

	/**
     * Override of callAction to perform the authorization before
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if ( ! $this->checkPermission('', $parameters) )
            return view('errors.forbidden');

        return parent::callAction($method, $parameters);
    }

    /**
     * checkPermission for this action with the given slug.
     * If the logged in user is the Super Admin OR
     * the given slug is 'dashboard' then no need to check the permission
     *
     * @param  str $slug
     *
     * @return bool false if the permission not granted
     */
    private function checkPermission($slug = '', $model = Null)
    {
        if (\Request::ajax())
            return TRUE;

        $slug = (bool) $slug ? $slug : $this->getSlug();

        return (new Authorize(Auth::user(), $slug, $model))->check();
    }

    /**
     * Get the slug to check the action permission
     *
     * @return str $slug
     */
    private function getSlug($action = Null, $module = Null)
    {
        $temp1 = explode('.', \Request::route()->getName());
        $module = $module ? $module : array_slice($temp1, -2, 1)[0];
        $action = $action ? $action : array_slice($temp1, -1, 1)[0];

        if($this->isVendor($module))
            return $this->abilities[$action] . '_vendor';

        if($this->isUtility($module))
            return $this->abilities[$action] . '_utility';

        if($this->isAppearance($module))
            return 'customize_appearance';

        if ('update' == $action) {
            if($this->isUpdateException($module))
                return $action . '_' . snake_case($module);
        }

        return array_key_exists($action, $this->abilities) ? $this->abilities[$action] . '_' . snake_case($module) : $action;
    }

    /**
     * Check if module is an Vendor module.
     *
     * @param  str  $module
     *
     * @return boolean
     */
    private function isVendor($module)
    {
        return in_array($module, $this->vendor_modules);
    }

    /**
     * Check if module is an utility module.
     *
     * @param  str  $module
     *
     * @return boolean
     */
    private function isUtility($module)
    {
        return in_array($module, $this->utility_modules);
    }

    private function isAppearance($module)
    {
        return in_array($module, $this->appearance_modules);
    }

    /**
     * Check if module is an Support module.
     *
     * @param  str  $module
     *
     * @return boolean
     */
    private function isUpdateException($module)
    {
        return in_array($module, $this->update_exception_modules);
    }
}