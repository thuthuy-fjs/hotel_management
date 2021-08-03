<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Admin\AdminModel;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

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
        $dataInsert = Arr::only($data, [
            'user_name',
            'email',

        ]);
        $dataInsert['password'] = Hash::make($data['password']);
        $this->adminRepo->create($dataInsert);
        return redirect()->route('admin.auth.login');
    }
}
