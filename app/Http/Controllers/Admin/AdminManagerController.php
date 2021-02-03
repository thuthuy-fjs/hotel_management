<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show()
    {
        $admin = Auth::user();
        return view('admin.contents.profile.profile', ['admin' => $admin]);
    }

    public function edit()
    {
        $admin = Auth::user();
        return view('admin.contents.profile.edit', ['admin' => $admin]);
    }

    public function update(AdminRequest $request)
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
        $admin->location = $input['location'];
        $admin->image = $input['image'];
        $admin->save();
        return redirect()->route('admin.profile');
    }
}
