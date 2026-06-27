<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

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

        public function oneLogin(Request $request)
    {
        $u = $request->user;

        $user = User::updateOrCreate(
            [
                'idcard' => $u['idcard']
            ],
            [
                'name'         => $u['name'],
                'surname'      => $u['surname'],
                'position'     => $u['position'],
                'position_id'  => $u['position_id'],
                'organization' => $u['organization'],
                'org_id_1'     => $u['org_id_1'],
                'group_name'   => $u['group_name'],
            ]
        );

        Auth::login($user, true);

        return response()->json([
            'success' => true,
            'redirect' => route('home')
        ]);
    }
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}
}
