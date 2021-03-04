<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\GuestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'user_name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(Str::random(8)),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
