<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Auth;

class AdminManagerController extends Controller
{
    protected $adminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    /**
     *
     * @param
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $admin = Auth::user();
        return view('admin.contents.profile.profile', ['admin' => $admin]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.contents.profile.edit', ['admin' => $admin]);
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request)
    {
        $input = $request->all();
        $this->adminRepo->update(Auth::id(), $input);
        return redirect()->back();
    }
}
