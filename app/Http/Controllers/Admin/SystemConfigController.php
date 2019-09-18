<?php

namespace App\Http\Controllers\Admin;

use App\SystemConfig;
use App\PaymentMethod;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\System\SystemConfigUpdated;
use App\Http\Requests\Validations\UpdateSystemConfigRequest;

class SystemConfigController extends Controller
{
    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->model_name = trans('app.model.config');
    }

   /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('view', $system); // Check permission

        return view('admin.system.config', compact('system'));
    }

    public function update(UpdateSystemConfigRequest $request)
    {
        if( env('APP_DEMO') == true )
            return response('error', 444);

        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('update', $system); // Check permission

        if($system->update($request->all())){
            event(new SystemConfigUpdated($system));

            return response("success", 200);
        }

        return response('error', 405);
    }

    /**
     * Toggle payment method of the given id, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePaymentMethod(UpdateSystemConfigRequest $request, $id)
    {
        if( env('APP_DEMO') == true )
            return response('error', 444);

        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('update', $system);    // Check permission

        $paymentMethod = PaymentMethod::findOrFail($id);

        $paymentMethod->enabled = !$paymentMethod->enabled;

        if($paymentMethod->save()){
            event(new SystemConfigUpdated($system));

            return response("success", 200);
        }

        return response('error', 405);
    }

    /**
     * Toggle notification of the given node, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str  $node
     * @return \Illuminate\Http\Response
     */
    public function toggleNotification(UpdateSystemConfigRequest $request, $node)
    {
        if( env('APP_DEMO') == true )
            return response('error', 444);

        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('update', $system); // Check permission

        $system->$node = !$system->$node;

        if($system->save()){
            event(new SystemConfigUpdated($system));

            return response("success", 200);
        }

        return response('error', 405);
    }
}
