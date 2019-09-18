<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;
use App\Jobs\SendContactFromMessageToAdmin;
use App\Http\Requests\Validations\ContactUsRequest;

class ContactUsController extends Controller
{
    private $model;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = trans('app.model.message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(ContactUsRequest $request)
    {
        $message = ContactUS::create($request->all());

        // Dispatching SendContactFromMessageToAdmin job
        SendContactFromMessageToAdmin::dispatch($message);

        if($request->ajax())
            return response(trans('messages.sent', ['model' => $this->model]), 200);

       return back()->with('success', trans('messages.sent', ['model' => $this->model]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
