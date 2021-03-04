<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin\AdminModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginAdmin(LoginRequest $request)
    {
        $validated = $request->validated();
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password], $request->remember
        )) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        dd($user);
//        $admin = $this->findOrCreateUser($user, $provider);
//        Auth::login($admin, true);
//        return redirect()->route('admin.dashboard');
    }

    public function findOrCreateUser($user, $provider)
    {
        $admin = AdminModel::where('email', $user->email)->first();
        if ($admin) {
            return $admin;
        }
        return AdminModel::create([
            'user_name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(Str::random(8)),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.auth.login');
    }
}
