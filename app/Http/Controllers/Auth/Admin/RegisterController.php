<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
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

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $adminModel = new AdminModel();
        $adminModel->user_name = $request->user_name;
        $adminModel->email = $request->email;
        $adminModel->password = bcrypt($request->password);
        $adminModel->save();
        return redirect()->route('admin.auth.login');
    }
}
