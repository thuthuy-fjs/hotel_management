<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Frontend\GuestModel;
use Illuminate\Http\Request;use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        return view('frontend.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $adminModel = new GuestModel();
        $adminModel->user_name = $request->user_name;
        $adminModel->email = $request->email;
        $adminModel->password = bcrypt($request->password);
        $adminModel->save();
        return redirect()->route('login');
    }
}
