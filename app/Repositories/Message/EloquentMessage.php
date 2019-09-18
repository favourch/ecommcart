<?php

namespace App\Repositories\Message;

use Auth;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentMessage extends EloquentRepository implements BaseRepository, MessageRepository
{
	protected $model;

	public function __construct(Message $message)
	{
		$this->model = $message;
	}

    public function labelOf($label)
    {
        return $this->model->mine()->labelOf($label)->with('customer')->withCount('replies')->orderBy('updated_at', 'desc')->paginate(getPaginationValue());
    }

    public function statusOf($status)
    {
        return $this->model->mine()->statusOf($status)->with('customer')->withCount('replies')->orderBy('updated_at', 'desc')->paginate(getPaginationValue());
    }

    public function updateStatusOrLabel(Request $request, $message, $statusOrLabel, $type)
    {
        if(! $message instanceof Message)
            $message = Message::findorFail($message);

        if ($type == 'status')
            $data['status'] = $statusOrLabel;
        else
            $data['label'] = $statusOrLabel;

        return $message->update($data);
    }

    public function massUpdate($ids, $statusOrLabel, $type)
    {
        return $this->model->whereIn('id', $ids)->update([$type => $statusOrLabel]);
    }

    public function markAsRead(Request $request, $message)
    {
        return $this->updateStatusOrLabel($request, $message, Message::STATUS_READ, 'status');
    }

    public function createdByMe()
    {
        return $this->model->createdByMe()->with('customer')->withCount('replies')->get();
    }

    public function store(Request $request)
    {
        $message = $this->model->create($request->all());

        if ($request->hasFile('attachments'))
            $message->saveAttachments($request->file('attachments'));

        return $message;
    }

    public function show($id)
    {
        return $this->model->with(['replies' => function($query){
            $query->with('attachments', 'user')->orderBy('id', 'desc');
        }])->find($id);
    }

    public function update(Request $request, $id)
    {
        $message = $this->model->find($id);

        $message->update($request->all());

        if ($request->hasFile('attachments'))
            $message->saveAttachments($request->file('attachments'));

        return $message;
    }

    public function storeReply(Request $request, $id)
    {
        $message = $this->model->find($id);

        $message->update($request->all());

        $reply = $message->replies()->create($request->all());

        if ($request->hasFile('attachments'))
            $reply->saveAttachments($request->file('attachments'));

        return $reply;
    }

    public function destroy($message)
    {
        if(! $message instanceof Message)
            $message = Message::findorFail($message);

        if($message->hasAttachments())
            $message->flushAttachments();

        if($message->hasReplies())
            $message->flushReplies();

        return $message->forceDelete();
    }

    public function massDestroy($ids)
    {
        foreach ($ids as $id)
            $this->destroy($id);

        return true;
    }
}