<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->model_name = trans('app.model.notification');
    }

    /**
     * Show the notifications for the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return view('admin.notification.index');
    }

    /**
     * Mark all Notifications As Read.
     */
    public function markAllNotificationsAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return response("success", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  uuid  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($notification)
    {
        Auth::user()->notifications()->find($notification)->delete();

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll()
    {
        Auth::user()->notifications()->delete();

        return back()->with('success',  trans('messages.deleted', ['model' => str_plural($this->model_name)]));
    }
}
