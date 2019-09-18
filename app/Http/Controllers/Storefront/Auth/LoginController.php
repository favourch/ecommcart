<?php

namespace App\Http\Controllers\Storefront\Auth;

use Auth;
use Socialite;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest:customer')->except('logout');
      $this->middleware('guest:web')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
      return view('auth.login');
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(), true);

            return redirect()->route('customer.login')
            ->withErrors(trans('theme.notify.authentication_failed', ['msg' => $response['error']['message']]));
        }

        $customer = Customer::where('email', $user->email)->first();
        if ($customer){
            Auth::guard('customer')->login($customer);

            return redirect()->intended('/')->with('success', trans('theme.notify.logged_in_successfully'));
        }

        $customer = new Customer;
        $customer->name = $user->getName();
        $customer->nice_name = $user->getNickname();
        $customer->email = $user->getEmail();
        $customer->active = 1;
        $customer->save();

        $customer->saveImageFromUrl($user->avatar_original ?? $user->getAvatar());

        Auth::guard('customer')->login($customer);

        return redirect()->intended('/')->with('success', trans('theme.notify.logged_in_successfully'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
      $this->validate($request, [
          $this->username() => 'required|string',
          'password' => 'required|string',
      ]);

      // If the class is using the ThrottlesLogins trait, we can automatically throttle
      // the login attempts for this application. We'll key this by the username and
      // the IP address of the client making these requests into this application.
      if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return $this->sendLockoutResponse($request);
      }

      if ($this->attemptLogin($request)) {
        // if successful, then redirect to their intended location

        return redirect()->intended(url()->previous())->with('success', trans('theme.notify.logged_in_successfully'));
      }

      // If the login attempt was unsuccessful we will increment the number of attempts
      // to login and redirect the user back to the login form. Of course, when this
      // user surpasses their maximum number of attempts they will get locked out.
      $this->incrementLoginAttempts($request);

      return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::guard('customer')->attempt(
            $request->only($this->username(), 'password'), $request->filled('remember')
        );
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        return redirect()->to('/')->with('success', trans('theme.notify.logged_out_successfully'));
    }
}
