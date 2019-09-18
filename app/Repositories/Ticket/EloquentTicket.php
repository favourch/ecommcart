<?php

namespace App\Repositories\Ticket;

use Auth;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentTicket extends EloquentRepository implements BaseRepository, TicketRepository
{
	protected $model;

	public function __construct(Ticket $ticket)
	{
		$this->model = $ticket;
	}

    public function open()
    {
        if (Auth::user()->isFromPlatform())
            return $this->model->open()->with('user', 'shop')->withCount('replies')->get();

        return $this->model->mine()->open()->with('user', 'shop')->withCount('replies')->get();
    }

    public function closed()
    {
        if (Auth::user()->isFromPlatform())
            return $this->model->closed()->with('user', 'shop')->withCount('replies')->get();

        return $this->model->mine()->closed()->with('user', 'shop')->withCount('replies')->get();
    }

    public function unAssigned()
    {
        return $this->model->unAssigned()->get();
    }

    public function assignedToMe()
    {
        return $this->model->assignedToMe()->with('user', 'shop')->withCount('replies')->get();
    }

    public function show($id)
    {
        return $this->model->with(['replies' => function($query){
            $query->with('attachments', 'user')->orderBy('id', 'desc');
        }])->find($id);
    }

    public function storeReply(Request $request, $id)
    {
        $ticket = $this->model->find($id);

        $ticket->update($request->except('user_id'));

        $reply = $ticket->replies()->create($request->all());

        if ($request->hasFile('attachments'))
            $reply->saveAttachments($request->file('attachments'));

        return $reply;
    }

    public function assign(Request $request, $id)
    {
        $ticket = $this->model->find($id);

        $ticket->update($request->all());

        return $ticket;
    }

    public function update(Request $request, $id)
    {
        $ticket = $this->model->find($id);

        $ticket->update($request->all());

        return $ticket;
    }

    public function reopen(Request $request, $id)
    {
        $ticket = $this->model->find($id);

        $ticket->update(['status' => Ticket::STATUS_OPEN]);

        return $ticket;
    }

    public function recentlyUpdated()
    {
        return $this->model->whereRaw("tickets.updated_at > '".Carbon::parse('-1 days')->toDateTimeString()."'")->get();
    }

    public function search($text)
    {
        return $this->model->where(function ($query) use ($text) {
            $query->where('subject', 'like', "%{$text}%")->orWhere('message', 'like', "%{$text}%");
        })->get();
    }
}