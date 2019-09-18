<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Config;
use App\ConfigStripe;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;

// use Stripe\Account as StripeAccount;
// use Stripe\Customer;
// use Stripe\Stripe as StripeBase;

class ConfigStripeController extends Controller
{
    // protected $client_id;
    // StripeBase::setApiKey(config('services.stripe.secret'));

    /**
     * Display a listing of the resource.
     */
    public function connect()
    {
        $url = "https://connect.stripe.com/oauth/authorize?response_type=code&client_id=" . config('services.stripe.client_id') . "&scope=read_write&state=" . csrf_token();

        return redirect()->to($url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        if(!$request->has('error') && $request->has('code')){

            $response = Curl::to('https://connect.stripe.com/oauth/token')
            ->withData([
                'client_secret' => config('services.stripe.secret'),
                'code' => $request->get('code'),
                'grant_type' => 'authorization_code',
            ])->post();

            $response = json_decode($response);

            if (!isset($response->error) && isset($response->stripe_user_id)){

                $shop_id = Auth::user()->merchantId();
                $config = Config::findOrFail($shop_id);

                $data['stripe_user_id'] = $response->stripe_user_id;
                $data['publishable_key'] = $response->stripe_publishable_key;
                $data['refresh_token'] = $response->refresh_token;

                $exist = $config->stripe;
                if ($exist) {
                    $config->stripe()->update($data);
                }else{
                    $config->stripe()->create($data);
                }

                return redirect()->route('admin.setting.config.paymentMethod.index')
                ->with('success', trans('messages.payment_method_activation_success'));
            }
        }

        return redirect()->route('admin.setting.config.paymentMethod.index')
        ->with('error', trans('messages.payment_method_activation_failed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function disconnect()
    {
        if( env('APP_DEMO') == true )
            return back()->with('warning', trans('messages.demo_restriction'));

        $config = Config::findOrFail(Auth::user()->merchantId());
        $stripe_user_id = optional($config->stripe)->stripe_user_id;

        $response = Curl::to('https://connect.stripe.com/oauth/deauthorize')
        ->withData([
            'client_secret' => config('services.stripe.secret'),
            'client_id' => config('services.stripe.client_id'),
            'stripe_user_id' => $stripe_user_id,
        ])->post();

        $response = json_decode($response);

        if (!isset($response->error) && isset($response->stripe_user_id)){

            ConfigStripe::destroy(Auth::user()->merchantId());

            return redirect()->route('admin.setting.config.paymentMethod.index')
            ->with('success', trans('messages.payment_method_disconnect_success'));
        }

        return redirect()->route('admin.setting.config.paymentMethod.index')
        ->with('error', trans('messages.payment_method_disconnect_failed'));
    }
}
