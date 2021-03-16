<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Frontend\GuestModel;
use App\Repositories\Frontend\GuestRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected $redirectTo = '/';
    protected $guestRepo;

    /**
     * LoginController constructor.
     * @param GuestRepository $guestRepo
     */
    public function __construct(GuestRepository $guestRepo)
    {
        $this->middleware('guest')->except('logout');
        $this->guestRepo = $guestRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('frontend.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            'user_name' => isset($user->name) ? $user->name : 'User',
            'email' => $user->email,
            'password' => Hash::make(Str::random(8)),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }
}
