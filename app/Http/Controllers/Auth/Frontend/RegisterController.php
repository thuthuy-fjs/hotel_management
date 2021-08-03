<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Repositories\Frontend\GuestRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

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
        $dataInsert = Arr::only($data, [
            'user_name',
            'email',
        ]);
        $dataInsert['password'] = Hash::make($data['password']);
        $this->guestRepo->create($dataInsert);
        return redirect()->route('login');
    }
}
