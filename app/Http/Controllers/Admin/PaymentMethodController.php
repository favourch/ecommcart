<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\PaymentMethod;
use Illuminate\Http\Request;
// use App\Common\Authorizable;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    // use Authorizable;

    private $model_name;

    public function __construct()
    {
        parent::__construct();
        $this->model_name = trans('app.model.payment_method');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $config = $this->checkPermission($request, 'view');

        return view('admin.config.payment-method.index');
    }

    public function activate(Request $request, $id)
    {
        $config = $this->checkPermission($request);

        $paymentMethod = PaymentMethod::findOrFail($id);

        $config->paymentMethods()->syncWithoutDetaching($id);

        switch ($paymentMethod->code) {
            case 'stripe':
                return redirect()->route('admin.setting.stripe.connect');
                break;

            case 'authorize-net':
                return redirect()->route('admin.setting.authorizeNet.activate');
                break;

            case 'instamojo':
                return redirect()->route('admin.setting.instamojo.activate');
                break;

            case 'paypal-express':
                return redirect()->route('admin.setting.paypalExpress.activate');
                break;

            case 'paystack':
                return redirect()->route('admin.setting.paystack.activate');
                break;

            case 'wire':
            case 'cod':
                return redirect()->route('admin.setting.manualPaymentMethod.activate', $paymentMethod->code);
                break;

            default:
                return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
                break;
        }
    }

    public function deactivate(Request $request, $id)
    {
        if( env('APP_DEMO') == true )
            return back()->with('warning', trans('messages.demo_restriction'));

        $config = $this->checkPermission($request);

        $paymentMethod = PaymentMethod::findOrFail($id);

        $config->paymentMethods()->detach($id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }


    public function activateManualPaymentMethod(Request $request, $code)
    {
        $config = $this->checkPermission($request);

        $paymentMethod = PaymentMethod::where('code', $code)->firstOrFail();

        $config->manualPaymentMethods()->syncWithoutDetaching($paymentMethod);

        $paymentMethod = $config->manualPaymentMethods->find($paymentMethod);

        return view('admin.config.payment-method.manual', compact('paymentMethod'));
    }

    public function deactivateManualPaymentMethod(Request $request, $code)
    {
        if( env('APP_DEMO') == true )
            return back()->with('warning', trans('messages.demo_restriction'));

        $config = $this->checkPermission($request);

        $paymentMethod = PaymentMethod::where('code', $code)->firstOrFail();

        $config->manualPaymentMethods()->detach($paymentMethod->id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    public function updateManualPaymentMethod(Request $request, $code)
    {
        if( env('APP_DEMO') == true )
            return back()->with('warning', trans('messages.demo_restriction'));

        $config = $this->checkPermission($request);

        $paymentMethod = PaymentMethod::where('code', $code)->firstOrFail();

        $data = [
            'additional_details' => $request->input('additional_details'),
            'payment_instructions' => $request->input('payment_instructions'),
        ];

        $config->manualPaymentMethods()->updateExistingPivot($paymentMethod->id, $data);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Check permission
     *
     * @return $config
     */
    private function checkPermission(Request $request, $action = 'update')
    {
        $config = Config::findOrFail($request->user()->merchantId());

        $this->authorize($action, $config);

        return $config;
    }

}
