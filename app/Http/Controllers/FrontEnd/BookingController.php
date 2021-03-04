<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Frontend\BookingModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        $input = $request->all();
        $booking = new BookingModel();
        $booking->guest_id = $input['guest_id'];
        $booking->room_id = $input['room_id'];
        $booking->booking_date = $input['booking_date'];
        $booking->check_in_date = Carbon::parse($input['check_in_date'])->format('Y-m-d H:i:s');
        $booking->check_out_date =Carbon::parse($input['check_out_date'])->format('Y-m-d H:i:s');
        $booking->booking_note = $input['booking_note'];
        $booking->is_payment = isset($input['is_payment']) ? $input['is_payment'] : 0;
        $booking->save();
//        dd($booking);
        return redirect()->route('home');
    }
}
