<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function sociallogin()
    {
        if ($type == 'google') {

            $user = Socialite::driver('google')->user();
            $data = User::where('email', $user->email)->first();
            $findUser = User::where('google_id', $user->id)->first();
            if ($data == null) {
                if ($findUser) {
                    Auth::login($findUser);
                    return redirect()->route('home');
                } else {
                    $findUser = new User();
                    $findUser->name = $user->name;
                    $findUser->email = $user->email;
                    // $findUser->status = '0';
                    $findUser->google_id = $user->id;
                    $findUser->password = uniqid();
                    $findUser->save();
                    Auth::login($findUser);
                    return redirect()->route('home');
            }
            } else if ($data->email == $user->email) {
                $data->google_id = $user->id;
                $data->save();
                Auth::login($data);
                return redirect()->route('home');
            }
        }
    }
}