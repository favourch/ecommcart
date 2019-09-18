<?php

namespace App\Http\Controllers\Admin;

use App\FaqTopic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateFaqTopicRequest;
use App\Http\Requests\Validations\UpdateFaqTopicRequest;

class FaqTopicController extends Controller
{

    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->model_name = trans('app.model.faqTopic');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq-topic._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFaqTopicRequest $request)
    {
        FaqTopic::create($request->all());

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FaqTopic  $FaqTopic
     * @return \Illuminate\Http\Response
     */
    public function edit(FaqTopic $faqTopic)
    {
        return view('admin.faq-topic._edit', compact('faqTopic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FaqTopic  $faqTopic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqTopicRequest $request, FaqTopic $faqTopic)
    {
        $faqTopic->update($request->all());

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = FaqTopic::findOrFail($id);

        if($topic->hasFaqs())
            return back()->with('error',  trans('messages.cant_delete_faq_topic', ['topic' => $topic->name]));

        $topic->forceDelete();

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }
}
