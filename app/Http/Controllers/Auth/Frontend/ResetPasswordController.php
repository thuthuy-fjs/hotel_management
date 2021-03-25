<?php

namespace App\Http\Controllers\Auth\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->with("error",
                "Mật khẩu không khớp. Vui lòng thử lại!");
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            return redirect()->back()->with("error",
                "Mật khẩu xác nhận không giống với mật khẩu mới. Vui lòng thử lại!");
        }

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with("success", "Đổi mật khẩu thành công!");
    }
}
