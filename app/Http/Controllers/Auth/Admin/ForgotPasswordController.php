<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
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
     */
    public function sendEmail(Request $request)
    {
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
        return view('admin.auth.forgot_password', ['token' => $token]);
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ]);
        $data = PasswordAdminReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($data->updated_at)->addMinutes(720)->isPast()) {
            $data->delete();
            return view('admin.auth.forgot_password', ['msg' => "Quá thời gian!"]);

        }
        $admin = AdminModel::where('email', $data->email)->firstOrFail();
        $admin->update(['password' => Hash::make($request->password)]);
        $data->delete();
        return redirect()->route('admin.auth.login');
    }
}
