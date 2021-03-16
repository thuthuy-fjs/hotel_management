<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Frontend\BookingModel;
use App\Repositories\Frontend\BookingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'guest_id',
            'room_id',
            'total_price',
            'booking_note',
        ]);
        $dataInsert['booking_date'] = Carbon::now()->format('Y-m-d H:i:s');
        $dataInsert['check_in_date'] = Carbon::parse($input['check_in_date'])->format('Y-m-d H:i:s');
        $dataInsert['check_out_date'] = Carbon::parse($input['check_out_date'])->format('Y-m-d H:i:s');
        $dataInsert['is_payment'] = isset($input['is_payment']) ? $input['is_payment'] : 0;

        $this->bookingRepo->create($dataInsert);
        return redirect()->route('home');
    }
}
