<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
//        $user = Socialite::driver($provider)->user();
//        dd($user);
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('admin.auth.login');
        }

        $admin = AdminModel::where('email', $user->email)->first();
        if ($admin) {
            return $admin;
        }
        $adminModel = new AdminModel();
        $adminModel->user_name = $user->name;
        $adminModel->email = $user->email;
        $adminModel->password = Hash::make(Str::random(8));
        $adminModel->provider = $provider;
        $adminModel->provider_id = $user->id;
        $adminModel->save();

        Auth::login($admin, true);
        return redirect()->route('home');

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
}
