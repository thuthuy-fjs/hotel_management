<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ChangePasswordRequest;
use App\Http\Requests\Frontend\GuestRequest;
use App\Models\Frontend\BookingModel;
use App\Models\Frontend\GuestModel;
use App\Repositories\Frontend\GuestRepository;
use App\Repositories\Frontend\StarRatingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestManagerController extends Controller
{
    protected $starRepo;
    protected $guestRepo;

    /**
     * GuestManagerController constructor.
     * @param StarRatingRepository $starRepo
     * @param GuestRepository $guestRepo
     */
    public function __construct(
        StarRatingRepository $starRepo,
        GuestRepository $guestRepo)
    {
        $this->starRepo = $starRepo;
        $this->guestRepo = $guestRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $guest = Auth::user();
        return view('frontend.contents.profile.profile')
            ->with('guest', $guest);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $guest = Auth::user();
        return view('frontend.contents.profile.edit', ['guest' => $guest]);
    }

    /**
     * @param GuestRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GuestRequest $request)
    {
        $directory = 'uploads/';
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'first_name',
            'last_name',
            'user_name',
            'email',
            'phone',
            'address',
            'password'
        ]);
        $image = $input['image'];
        if ($request->hasFile('image')) {
            $image_name = $image->getClientOriginalName();
            $image->move($directory, $image_name);
            $dataInsert['image'] = $image_name;
        } else {
            $dataInsert['image'] = $image;
        }
        $this->guestRepo->update(Auth::id(), $dataInsert);
        return redirect()->route('profile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword()
    {
        return view('frontend.auth.changepassword');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->with("error", "Mật khẩu không khớp. Vui lòng thử lại!");
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            return redirect()->back()->with("error", "Mật khẩu xác nhận không giống với mật khẩu mới. Vui lòng thử lại!");
        }

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with("success", "Đổi mật khẩu thành công!");
    }
}
