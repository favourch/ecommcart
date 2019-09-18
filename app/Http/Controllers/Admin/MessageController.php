<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Events\Message\NewMessage;
use App\Events\Message\MessageReplied;
use App\Repositories\Message\MessageRepository;
use App\Http\Requests\Validations\DraftSendRequest;
use App\Http\Requests\Validations\ReplyMessageRequest;
use App\Http\Requests\Validations\CreateMessageRequest;
use App\Http\Requests\Validations\UpdateMessageRequest;

class MessageController extends Controller
{
    use Authorizable;

    private $model;

    private $message;

    /**
     * construct
     */
    public function __construct(MessageRepository $message)
    {
        parent::__construct();

        $this->model = trans('app.model.message');

        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function labelOf($label = 1)
    {
        $messages = $this->message->labelOf($label);

        return view('admin.message.index', compact('messages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusOf($status = 1)
    {
        $messages = $this->message->statusOf($label);

        return view('admin.message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($template = Null)
    {
        return view('admin.message._create', compact('template'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        $message = $this->message->store($request);

        event(new NewMessage($message));

        return back()->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function draftSend(DraftSendRequest $request, $id)
    {
        $this->message->update($request, $id);

        if($request->has('draft'))
            return back()->with('success', trans('messages.updated', ['model' => $this->model]));

        return back()->with('success', trans('messages.sent', ['model' => $this->model]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $message = $this->message->find($id);

        $this->message->markAsRead($request, $message);

        return view('admin.message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = $this->message->find($id);

        return view('admin.message._edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $statusOrLabel, $type = 'label')
    {
        $message = $this->message->find($id);

        $backLabel = $message->label;

        $this->message->updateStatusOrLabel($request, $message, $statusOrLabel, $type);

        return redirect()->route('admin.support.message.labelOf', $backLabel)->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function massUpdate(Request $request, $statusOrLabel, $type = 'label')
    {
        $this->message->massUpdate($request->ids, $statusOrLabel, $type);

        return response()->json(['success' => trans('messages.updated', ['model' => $this->model])]);
    }

    /**
     * Display the reply form.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function reply($id, $template = Null)
    {
        $message = $this->message->find($id);

        return view('admin.message._reply', compact('message','template'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function storeReply(ReplyMessageRequest $request, $id)
    {
        $reply = $this->message->storeReply($request, $id);

        event(new MessageReplied($reply));

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $message = $this->message->find($id);

        $backLabel = $message->label;

        $this->message->destroy($message);

        return redirect()->route('admin.support.message.labelOf', $backLabel)->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    public function massDestroy(Request $request)
    {
        $this->message->massDestroy($request->ids);

        return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
    }
}
