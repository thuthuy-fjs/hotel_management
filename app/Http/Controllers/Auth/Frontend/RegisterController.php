<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Frontend\GuestModel;
use App\Repositories\Frontend\GuestRepository;

class RegisterController extends Controller
{
    protected $guestRepo;

    /**
     * RegisterController constructor.
     * @param GuestRepository $guestRepo
     */
    public function __construct(GuestRepository $guestRepo)
    {
        $this->middleware('guest')->only('index');
        $this->guestRepo = $guestRepo;
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
        return view('frontend.auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $this->guestRepo->create($data);
        return redirect()->route('login');
    }
}
