<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Admin\AdminModel;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $adminRepo;

    /**
     * RegisterController constructor.
     * @param AdminRepository $adminRepo
     */
    public function __construct(AdminRepository $adminRepo)
    {
        $this->middleware('auth:admin')->only('index');
        $this->adminRepo= $adminRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $this->adminRepo->create($data);
        return redirect()->route('admin.auth.login');
    }
}
