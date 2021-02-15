<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Admin\AdminModel;
use App\Models\Admin\PasswordAdminReset;
use Illuminate\Http\Request;
use DB;
use App\User;
use Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class ResetPasswordController extends Controller
{

    public function getEmail()
    {
        return view('admin.auth.reset');
    }

    public function sendEmail(Request $request)
    {
        $email = $request->email;
        $admin = AdminModel::where('email', $email)->firstOrFail();
        if ($admin) {
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


    public function getReset($token)
    {
        return view('admin.auth.resetpassword', ['token' => $token]);
    }

    public function resetPassword(Request $request, $token)
    {
        $data = PasswordAdminReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($data->updated_at)->addMinutes(720)->isPast()) {
            $data->delete();
            return view('admin.auth.resetpassword', ['msg' => "Quá thời gian!"]);

        }
        $admin = AdminModel::where('email', $data->email)->firstOrFail();
        $admin->update($request->only('password'));
        $data->delete();
        return redirect()->route('admin.auth.login');
    }

}