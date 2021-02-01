<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

        } else {
            dd('Login không thành công');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
