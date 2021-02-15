<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\UserResetPassword;
use App\Models\Frontend\GuestModel;
use App\Models\Frontend\PasswordGuestReset;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {
        return view('frontend.auth.forgot');
    }

    public function sendEmail(Request $request)
    {
        $email = $request->email;
        $guest = GuestModel::where('email', $email)->firstOrFail();
        if (asset($guest)) {
            $passwordReset = PasswordGuestReset::updateOrCreate([
                'email' => $guest->email,
            ], [
                'token' => Str::random(60),
            ]);
            Mail::to($email)->send(new UserResetPassword($passwordReset->token));
            return redirect()->back()->with('message', 'Một đường link thay đổi mật khẩu đã được gửi đến email của bạn!');
        } else {
            return redirect()->back()->with('message', 'Không tìm thấy email');
        }
    }


    public function getReset($token)
    {
        return view('frontend.auth.forgot_password', ['token' => $token]);
    }

    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ]);
        $data = PasswordGuestReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($data->updated_at)->addMinutes(720)->isPast()) {
            $data->delete();
            return view('frontend.auth.forgot_password', ['message' => "Quá thời gian!"]);

        }
        $guest = GuestModel::where('email', $data->email)->firstOrFail();
        $guest->update(['password' => Hash::make($request->password)]);
        $data->delete();
        return redirect()->route('login');
    }
}
