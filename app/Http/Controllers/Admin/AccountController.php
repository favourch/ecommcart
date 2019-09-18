<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\System;
use App\Ticket;
use App\Helpers\Authorize;
use Illuminate\Http\Request;
use App\Events\Ticket\TicketCreated;
use App\Events\Ticket\TicketReplied;
use App\Http\Controllers\Controller;
use App\Events\Profile\ProfileUpdated;
use App\Events\Profile\PasswordUpdated;
use App\Repositories\Account\AccountRepository;
use App\Http\Requests\Validations\UpdatePhotoRequest;
use App\Http\Requests\Validations\DeletePhotoRequest;
use App\Http\Requests\Validations\CreateTicketRequest;
use App\Http\Requests\Validations\ReplyTicketRequest;
use App\Http\Requests\Validations\UpdateProfileRequest;
use App\Http\Requests\Validations\UpdatePasswordRequest;
use App\Notifications\SuperAdmin\TicketCreated as TicketCreatedNotification;

class AccountController extends Controller
{
    private $profile;

    /**
     * construct
     */
    public function __construct(AccountRepository $profile)
    {
        parent::__construct();

        $this->profile = $profile;
    }

    /**
     * Show the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $profile = $this->profile->profile();

        return view('admin.account.index', compact('profile'));
    }

    /**
     * Display the specified resource.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function showTicket(Ticket $ticket)
    {
        if(!(new Authorize(Auth::user(), 'view_ticket', $ticket))->check())
            abort(403, 'Unauthorized action.');

        return view('admin.account.show_ticket', compact('ticket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTicket()
    {
        return view('admin.account._create_ticket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTicket(CreateTicketRequest $request)
    {
        $ticket = Ticket::create($request->all());

        if ($request->hasFile('attachments'))
            $ticket->saveAttachments($request->file('attachments'));

        // Send notification to Admin
        if(config('system_settings.notify_new_ticket')){
            $system = System::orderBy('id', 'asc')->first();

            $system->superAdmin()->notify(new TicketCreatedNotification($ticket));
        }

        event(new TicketCreated($ticket));

        return redirect()->route('admin.account.ticket')->with('success', trans('messages.created', ['model' => trans('app.model.ticket')]));
    }

    /**
     * Display the reply form.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function replyTicket(Ticket $ticket)
    {
        return view('admin.account._reply_ticket', compact('ticket'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function storeTicketReply(ReplyTicketRequest $request, Ticket $ticket)
    {
        if(!(new Authorize(Auth::user(), 'reply_ticket', $ticket))->check())
            abort(403, 'Unauthorized action.');

        $ticket->update($request->except('user_id'));

        $reply = $ticket->replies()->create($request->all());

        if ($request->hasFile('attachments'))
            $reply->saveAttachments($request->file('attachments'));

        event(new TicketReplied($reply));

        return redirect()->route('admin.account.ticket')->with('success', trans('messages.updated', ['model' => trans('app.model.ticket')]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function archiveTicket(Request $request, Ticket $ticket)
    {
        if(Auth::id() != $ticket->user_id)
            abort(403, 'Unauthorized action.');

        $ticket->delete();

        return redirect()->route('admin.account.ticket')->with('success', trans('messages.deleted', ['model' => trans('app.model.ticket')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('admin.account._change_password');
    }

    /**
     * Update profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        if( env('APP_DEMO') == true && Auth::user()->id <= config('system.demo.users', 3) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $profile = $this->profile->updateProfile($request);

        event(new ProfileUpdated(Auth::user()));

        return redirect()->route('admin.account.profile')->with('success', trans('messages.profile_updated'));
    }

    /**
     * Update login password only.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if( env('APP_DEMO') == true && Auth::user()->id <= config('system.demo.users', 3) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $profile = $this->profile->updatePassword($request);

        event(new PasswordUpdated(Auth::user()));

        return redirect()->route('admin.account.profile')->with('success', trans('messages.password_updated'));
    }

    /**
     * Update Photo only.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(UpdatePhotoRequest $request)
    {
        $this->profile->updatePhoto($request);

        return redirect()->route('admin.account.profile')->with('success', trans('messages.profile_updated'));
    }

    /**
     * Remove photo from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePhoto(DeletePhotoRequest $request)
    {
        $this->profile->deletePhoto($request);

        return redirect()->route('admin.account.profile')->with('success', trans('messages.profile_updated'));
    }
}