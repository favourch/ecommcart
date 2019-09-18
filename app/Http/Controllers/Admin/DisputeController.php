<?php

namespace App\Http\Controllers\Admin;

use App\System;
use App\Dispute;
use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
// use App\Events\Dispute\DisputeCreated;
use App\Events\Dispute\DisputeUpdated;
use App\Repositories\Dispute\DisputeRepository;
use App\Http\Requests\Validations\CreateDisputeRequest;
use App\Http\Requests\Validations\ResponseDisputeRequest;
use App\Notifications\SuperAdmin\DisputeAppealed as DisputeAppealedNotification;
use App\Notifications\SuperAdmin\AppealedDisputeReplied as AppealedDisputeRepliedNotification;

class DisputeController extends Controller
{
    use Authorizable;

    private $model_name;

    private $dispute;

    /**
     * construct
     */
    public function __construct(DisputeRepository $dispute)
    {
        parent::__construct();

        $this->model_name = trans('app.model.dispute');

        $this->dispute = $dispute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disputes = $this->dispute->open();

        $closed = $this->dispute->closed();

        return view('admin.dispute.index', compact('disputes', 'closed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.dispute._create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(CreateDisputeRequest $request)
    // {
    //     $dispute = $this->dispute->store($request);

    //     event(new DisputeCreated($dispute));

    //     return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    // }

    /**
     * Display the specified resource.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dispute = $this->dispute->find($id);

        return view('admin.dispute.show', compact('dispute'));
    }

    /**
     * Display the response form.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function response($id)
    {
        $dispute = $this->dispute->find($id);

        return view('admin.dispute._response', compact('dispute'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function storeResponse(ResponseDisputeRequest $request, $id)
    {
        $dispute = $this->dispute->find($id);

        $old_status = $dispute->status;

        $response = $this->dispute->storeResponse($request, $dispute);

        $current_status = $response->repliable->status;

        // Send notification to Admin
        if( config('system_settings.notify_when_dispute_appealed') && ($current_status == Dispute::STATUS_APPEALED)){
            $system = System::orderBy('id', 'asc')->first();

            if($current_status != $old_status)
                $system->superAdmin()->notify(new DisputeAppealedNotification($response));
            else
                $system->superAdmin()->notify(new AppealedDisputeRepliedNotification($response));
        }

        event(new DisputeUpdated($response));

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }
}
