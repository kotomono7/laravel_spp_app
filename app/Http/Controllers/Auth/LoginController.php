<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    /**
     * The function redirects the user to different routes based on their role, and logs them out if
     * they don't have access.
     *
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request made to the application.
     * @param user The  parameter is an instance of the User model, which represents the
     * authenticated user. It contains information about the user, such as their role.
     *
     * @return a redirect to a specific route based on the user's role. If the user's role is 'ADMIN',
     * it will redirect to the 'admin.dashboard' route. If the user's role is 'WALI', it will redirect
     * to the 'wali.home' route. If the user's role is 'OPERATOR', it will redirect to the
     * 'operator.home' route
     */
    public function authenticated(Request $request, $user)
    {
        if ($user->role == 'ADMIN')
        {
            return redirect()->route('admin.dashboard');
        } else if ($user->role == 'WALI')
        {
            return redirect()->route('wali.home');
        } else if ($user->role == 'OPERATOR')
        {
            return redirect()->route('operator.home');
        } else
        {
            flash('Anda tidak memiliki hak akses!')->error();

            Auth::logout();
            return redirect()->route('login');
        }
    }
}
