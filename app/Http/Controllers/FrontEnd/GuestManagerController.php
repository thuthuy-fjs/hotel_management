<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\GuestRequest;
use App\Models\Frontend\BookingModel;
use App\Models\Frontend\GuestModel;
use App\Repositories\Frontend\StarRatingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestManagerController extends Controller
{
    protected $starRepo;

    public function __construct(StarRatingRepository $starRepo)
    {
        $this->starRepo = $starRepo;
    }

    public function show()
    {
        $guest = Auth::user();
        $star_ratings = $this->starRepo->getAll();
        return view('frontend.contents.profile.profile')
            ->with('guest', $guest)->with('star_ratings', $star_ratings);
    }

    public function edit()
    {
        $guest = Auth::user();
        return view('frontend.contents.profile.edit', ['guest' => $guest]);
    }

    public function update(GuestRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();
        $guest = Auth::user();
        $guest->first_name = $input['first_name'];
        $guest->last_name = $input['last_name'];
        $guest->user_name = $input['user_name'];
        $guest->email = $input['email'];
        $guest->password = $input['password'];
        $guest->phone = $input['phone'];
        $guest->address = $input['address'];
        $guest->image = $input['image'];
        $guest->save();
        return redirect()->route('profile');
    }

    public function updatePassword(Request $request)
    {
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
