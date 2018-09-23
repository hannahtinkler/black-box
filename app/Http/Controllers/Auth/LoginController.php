<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

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
     * @param UserRepository $users
     * @param Bitbucket      $bitbucket
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function login()
    {
        return Socialite::driver('bitbucket')->redirect();
    }

    /**
     * @return Redirect
     */
    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }

    /**
     * Retrieves the user froim Bitbucket and if they pass the requirements to
     * be able to log in, log them in. Registers them first if necessary. Checks
     * they are authorized to access based on their Bitbucket team and then
     * sends them to the URL they were trying to access, or home if n/a
     *
     * @return Redirect
     */
    public function loginWithBitbucket()
    {
        $socialite = Socialite::driver('bitbucket')->user();

        if (!$this->users->canLoginOrRegister($socialite)) {
            return redirect()->route('auth.access-denied');
        }

        $user = $this->users->loginOrRegister($socialite);

        if ($user->cannot('access', $user)) {
            return redirect()->route('login.denied');
        }

        $url = session()->get('url.target') ?: '/';
        session()->forget('url.target');

        return redirect()->to($url);
    }

    /**
     * @return View
     */
    public function accessDenied()
    {
        return view('auth.access-denied');
    }
}
