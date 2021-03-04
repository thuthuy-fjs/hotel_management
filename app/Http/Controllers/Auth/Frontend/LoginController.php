<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Frontend\GuestModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('frontend.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $validated = $request->validated();
        if (Auth::guard('web')->attempt(
            ['email' => $request->email, 'password' => $request->password], $request->remember
        )) {
            return redirect()->route('home');

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
        $guest = $this->findOrCreateUser($user, $provider);
        Auth::login($guest, true);
        return redirect()->route('home');

    }

    public function findOrCreateUser($user, $provider)
    {
        $guest = GuestModel::where('email', $user->email)->first();
        if ($guest) {
            return $guest;
        }
        return GuestModel::create([
            'user_name' => isset($user->name) ? $user->name : 'User',
            'email' => $user->email,
            'password' => Hash::make(Str::random(8)),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('home');
    }
}
