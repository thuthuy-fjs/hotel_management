<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\GuestModel;
use App\Repositories\Frontend\GuestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected $guestRepo;

    public function __construct(GuestRepository $guestRepo)
    {
        $this->guestRepo = $guestRepo;
    }

    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $guest = $this->findOrCreateUser($user, $provider);
        Auth::login($guest, true);
        return redirect()->route('home');

    }

    /**
     * @param $user
     * @param $provider
     * @return mixed
     */
    public function findOrCreateUser($user, $provider)
    {
        $guest = GuestModel::where('email', $user->email)->first();
        if ($guest) {
            return $guest;
        }
        return $this->guestRepo->create([
            'user_name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(Str::random(8)),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
