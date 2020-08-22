<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Log;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        Log::create([
            'log_name' => 'default',
            'description' => 'login',
            'causer_id' => $this->guard()->user()->id,
            'causer_type' => 'App\User',
        ]);


        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 204)
                    : redirect()->intended($this->redirectPath());
    }
    public function logout(Request $request)
    {
        Log::create([
            'log_name' => 'default',
            'description' => 'logout',
            'causer_id' => $this->guard()->user()->id,
            'causer_type' => 'App\User',
        ]);
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    function authenticated(Request $request, $user)
{
        $user->update([
            'last_login_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
    ]);
}
}
