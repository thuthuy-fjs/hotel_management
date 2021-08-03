<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use App\Mail\SendMailToUser;
use App\Models\Frontend\BookingModel;
use App\Repositories\Frontend\BookingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    protected $bookingRepo;

    /**
     * BookingController constructor.
     * @param BookingRepository $bookingRepo
     */
    public function __construct(BookingRepository $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }

    /**
     * @param BookingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookingRequest $request)
    {
        $input = $request->all();
        $room_id = $input['room_id'];
        $total_price = $input['total_price'];
        $hotel_name = $input['hotel_name'];
        $number_room = $input['number_room'];
        //dd($number_room[0]);
        for ($i = 0; $i < count($room_id); $i++) {
            if ($number_room[$i] > 0) {
                $dataInsert = Arr::only($input, [
                    'guest_id',
                    'name',
                    'email',
                    'booking_note',
                    'payment_id'
                ]);
                $dataInsert['room_id'] = $room_id[$i];
                $dataInsert['total_price'] = $total_price[$i];
                $dataInsert['number_room'] = $number_room[$i];
                $dataInsert['booking_date'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $dataInsert['check_in_date'] = Carbon::parse($input['check_in_date'])->format('Y-m-d H:i:s');
                $dataInsert['check_out_date'] = Carbon::parse($input['check_out_date'])->format('Y-m-d H:i:s');
                $dataInsert['is_payment'] = $input['payment_id'];
                $this->bookingRepo->create($dataInsert);
                //DB::table('room')->where('id', $room_id[$i])->decrement('room_number', $number_room[$i]);
            }
        }
        Mail::to($dataInsert['email'])->send(new SendMailToUser($hotel_name, $input['total'],
            Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            $input['check_in_date'], $input['check_out_date'], $input['payment_id']));
        if (Auth::check()) {
            if ($input['payment_id'] == 1) {
                return redirect()->route('booking.list');
            } elseif ($input['payment_id'] == 2) {
                return redirect()->route('payment-vnpay', ['total_price' => $input['total']]);
            }
        } else {
            if ($input['payment_id'] == 1) {
                return redirect()->route('payment')->with('success', "Đặt phòng thành công!");
            } elseif ($input['payment_id'] == 2) {
                return redirect()->route('payment-vnpay', ['total_price' => $input['total']]);
            }

        }

    }
}
