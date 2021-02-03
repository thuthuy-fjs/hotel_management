<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\GuestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestManagerController extends Controller
{
    public function show()
    {
        $guest = Auth::user();
        return view('frontend.contents.profile.profile', ['guest' => $guest]);
    }

    public function edit()
    {
        $guest = Auth::user();
        return view('frontend.contents.profile.edit', ['guest' => $guest]);
    }

    public function update(GuestRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();
        $admin = Auth::user();
        $admin->first_name = $input['first_name'];
        $admin->last_name = $input['last_name'];
        $admin->user_name = $input['user_name'];
        $admin->email = $input['email'];
        $admin->password = $input['password'];
        $admin->phone = $input['phone'];
        $admin->address = $input['address'];
        $admin->image = $input['image'];
        $admin->save();
        return redirect()->route('profile');
    }
}
