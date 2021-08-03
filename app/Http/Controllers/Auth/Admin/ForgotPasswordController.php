<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Admin\AdminModel;
use App\Models\Admin\PasswordAdminReset;
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
        return view('admin.auth.forgot');
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
                'email' => 'required|email|exists:admins,email',
            ],

            [
                'email.required' => 'Email là bắt buộc',
                'email.email' => 'Email chưa đúng định dạng',
                'email.exists' => 'Email không tồn tại',
            ]

        );
        $email = $request->email;
        $admin = AdminModel::where('email', $email)->firstOrFail();
        if (asset($admin)) {
            $passwordReset = PasswordAdminReset::updateOrCreate([
                'email' => $admin->email,
            ], [
                'token' => Str::random(60),
            ]);
            Mail::to($email)->send(new ResetPassword($passwordReset->token));
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
        $data = PasswordAdminReset::where('token', $token)->firstOrFail();
        if (isset($data)) {
            return view('admin.auth.forgot_password', ['token' => $token]);
        }
    }

    /**
     * @param ResetPasswordRequest $request
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resetPassword(ResetPasswordRequest $request, $token)
    {
        $data = PasswordAdminReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($data->updated_at)->addMinutes(720)->isPast()) {
            $data->delete();
            return view('admin.auth.forgot_password', ['message' => "Link đặt lại mật khẩu này không hợp lệ!"]);
        }
        $admin = AdminModel::where('email', $data->email)->firstOrFail();
        $admin->update(['password' => Hash::make($request->password)]);
        $data->delete();
        return redirect()->route('admin.auth.login');

    }
}
