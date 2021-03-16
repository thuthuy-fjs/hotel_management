<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
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
        ]);
        $dataInsert['password'] = bcrypt($input['password']);
        $image = $input['image'];
        $image_name = $image->getClientOriginalName();
        $image->move($directory, $image_name);
        $dataInsert['image'] = $image_name;
        $this->guestRepo->update(Auth::id(), $dataInsert);
        return redirect()->route('profile');
    }

    /**
     * @param GuestRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(GuestRequest $request)
    {
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided.
             Please try again.");
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password. 
            Please choose a different password.");
        }

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
