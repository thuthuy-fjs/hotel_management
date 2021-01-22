<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth:admin')->only('index');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        return view('admin.auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'user_name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ));

        $adminModel = new AdminModel();
        $adminModel->user_name = $request->user_name;
        $adminModel->email = $request->email;
        $adminModel->password = bcrypt($request->password);
        $adminModel->save();
        return redirect()->route('admin.auth.login');
    }
}
