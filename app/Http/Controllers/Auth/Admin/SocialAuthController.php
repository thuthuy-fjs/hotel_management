<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        dd($user);
//        try {
//            $user = Socialite::driver($provider)->user();
//            dd($user);
//        } catch (\Exception $e) {
//            return redirect()->route('admin.auth.login');
//        }

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
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(Str::random(8)),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
