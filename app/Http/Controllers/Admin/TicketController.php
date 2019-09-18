<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Events\Ticket\TicketUpdated;
use App\Events\Ticket\TicketReplied;
use App\Events\Ticket\TicketAssigned;
use App\Repositories\Ticket\TicketRepository;
use App\Http\Requests\Validations\ReplyTicketRequest;
use App\Http\Requests\Validations\UpdateTicketRequest;

class TicketController extends Controller
{
    use Authorizable;

    private $model;

    private $ticket;

    /**
     * construct
     */
    public function __construct(TicketRepository $ticket)
    {
        parent::__construct();

        $this->model = trans('app.model.ticket');

        $this->ticket = $ticket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = $this->ticket->open();

        $closed = $this->ticket->closed();

        $assigned = $this->ticket->assignedToMe();

        return view('admin.ticket.index', compact('tickets', 'assigned', 'closed'));
    }

    /**
     * Display the specified resource.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = $this->ticket->find($id);

        return view('admin.ticket.show', compact('ticket'));
    }

    /**
     * Display the reply form.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function reply($id)
    {
        $ticket = $this->ticket->find($id);

        return view('admin.ticket._reply', compact('ticket'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function storeReply(ReplyTicketRequest $request, $id)
    {
        $reply = $this->ticket->storeReply($request, $id);

        event(new TicketReplied($reply));

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Display the assign form.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function showAssignForm($id)
    {
        $ticket = $this->ticket->find($id);

        return view('admin.ticket._assign', compact('ticket'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request, $id)
    {
        $ticket = $this->ticket->assign($request, $id);

        event(new TicketAssigned($ticket));

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Display the edit form.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = $this->ticket->find($id);

        return view('admin.ticket._edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $ticket = $this->ticket->update($request, $id);

        event(new TicketUpdated($ticket));

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Reopen the ticket.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */
    public function reopen(Request $request, $id)
    {
        $ticket = $this->ticket->reopen($request, $id);

        event(new TicketUpdated($ticket));

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, $id)
    {
        $this->ticket->trash($id);

        return redirect()->route('admin.support.ticket.index')->with('success', trans('messages.archived', ['model' => $this->model]));
    }
}
