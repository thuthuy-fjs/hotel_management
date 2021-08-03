<?php

namespace App\Http\Controllers;

use App\Models\Frontend\BookingModel;
use App\Models\Frontend\GuestModel;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Frontend\BookingRepository;
use App\Repositories\Frontend\GuestRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected $bookingRepo;
    protected $hotelRepo;
    protected $countryRepo;
    protected $guestRepo;


    public function __construct(
        BookingRepository $bookingRepo,
        HotelRepository $hotelRepo,
        GuestRepository $guestRepo,
        CountryRepository $countryRepo)
    {
        $this->bookingRepo = $bookingRepo;
        $this->hotelRepo = $hotelRepo;
        $this->countryRepo = $countryRepo;
        $this->guestRepo = $guestRepo;
    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        $guests = $this->guestRepo->getAll();
        $bookings = $this->bookingRepo->getAll();
        $data1 = DB::table('booking')
            ->select(
                DB::raw('month(booking_date) as month'),
                DB::raw('count(*) as total'))
            ->groupBy('month')
            ->get();
        $array1[] = ["Tháng", "Đơn đặt phòng"];
        foreach ($data1 as $key => $value) {
            $array1[++$key] = [$value->month, $value->total];
        }

        $data2 = DB::table('booking')
            ->select(
                DB::raw('month(booking_date) as month'),
                DB::raw('sum(total_price) as total_price'))
            ->groupBy('month')
            ->get();
        $array2[] = ["Tháng", "Doanh thu"];
        foreach ($data2 as $key => $value) {
            $array2[++$key] = [$value->month, (integer)$value->total_price];
        }
        //dd($array2);
        return view('admin.dashboard')->with('countries', $countries)
            ->with('hotels', $hotels)->with('guests', $guests)
            ->with('bookings', $bookings)->with('booking_total', json_encode($array1))
            ->with('total_price', json_encode($array2));
    }
}
