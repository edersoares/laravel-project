<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as UserProvider;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param string $provider
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param string $provider
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        return $this->loginUsingUserProvider($user);
    }

    /**
     * Authenticate using a User Provider by Socialite.
     *
     * @param UserProvider $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function loginUsingUserProvider(UserProvider $user)
    {
        $authenticated = User::where('email', $user->getEmail())->first();

        if (empty($authenticated)) {
            $authenticated = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => md5(time()),
            ]);
        }

        Auth::login($authenticated);

        return redirect($this->redirectTo);
    }
}
