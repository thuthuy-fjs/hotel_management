<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ResetPasswordRequest;
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
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmail()
    {
        return view('frontend.auth.forgot');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendEmail(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email|exists:guests,email',
            ],

            [
                'email.required' => 'Email là bắt buộc',
                'email.email' => 'Email chưa đúng định dạng',
                'email.exists' => 'Email không tồn tại',
            ]

        );
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

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReset($token)
    {
        $data = PasswordGuestReset::where('token', $token)->firstOrFail();
        if (isset($data)) {
            return view('frontend.auth.forgot_password', ['token' => $token]);
        }
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resetPassword(ResetPasswordRequest $request, $token)
    {
        $data = PasswordGuestReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($data->updated_at)->addMinutes(720)->isPast()) {
            $data->delete();
            return view('frontend.auth.forgot_password', ['message' => "Link đặt lại mật khẩu này không hợp lệ"]);

        }
        $guest = GuestModel::where('email', $data->email)->firstOrFail();
        $guest->update(['password' => Hash::make($request->password)]);
        $data->delete();
        return redirect()->route('login');
    }
}
