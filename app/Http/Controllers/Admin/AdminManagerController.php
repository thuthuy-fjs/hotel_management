<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function update(Request $request)
    {
//        $this->validate($request, array(
//            'first_name' => 'required',
//            'last_name' => 'required',
//            'user_name' => 'required',
//            'email' => 'required|email',
//            'password' => 'min:8',
//            'phone' => 'required',
//            'location' => 'required',
//            'image' => 'required',
//        ));
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
        //dd($input);
        return redirect()->route('admin.profile');
    }
}
