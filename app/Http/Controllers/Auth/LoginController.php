<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

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
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
            "publish_to_groups","manage_pages", "publish_pages"])->redirect();
    }

    public function handleProviderFacebookCallback() {

        $auth_user = Socialite::driver('facebook')->user();

        $findUser = User::where('email', $auth_user->email)->first();      

        if($findUser) {
            Auth::login($findUser, true);

            return redirect()->to('/home'); // Redirect to a secure page
        } else {
            $user = new User;
            $user->email = $auth_user->email;
            $user->token = $auth_user->token;
            $user->name = $auth_user->name;
            $user->save();
            Auth::login($user, true);

            return redirect()->to('/home'); // Redirect to a secure page
        }

    }

}