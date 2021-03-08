<?php

namespace App\Http\Controllers;

use App\Models\Frontend\BookingModel;
use App\Models\Frontend\GuestModel;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Admin\RoomTypeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected $roomRepo;
    protected $hotelRepo;
    protected $roomtypeRepo;
    protected $countryRepo;
    protected $provinceRepo;

    public function __construct(RoomRepository $roomRepo, HotelRepository $hotelRepo,
                                RoomTypeRepository $roomtypeRepo, ProvinceRepository $provinceRepo, CountryRepository $countryRepo)
    {
        $this->middleware('auth:admin');
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->roomtypeRepo = $roomtypeRepo;
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
    }

    public function index(){
        $countries = $this->countryRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        $guests = GuestModel::all();
        $bookings = BookingModel::all();
        $data1 = DB::table('booking')
            ->select(
                DB::raw('month(booking_date) as month' ),
                DB::raw('count(*) as total'))
            ->groupBy('month')
            ->get();
        $months = [];
        $total_booking = [];
        $array1[] = ['Month', 'Total'];
        foreach($data1 as $key => $value)
        {
            $array1[++$key] = [$value->month, $value->total];
//            $months[$key] = $value->month;
//            $total_booking[$key] = $value->total;
        }
        return view('admin.dashboard')->with('countries', $countries)
            ->with('hotels', $hotels)->with('guests', $guests)
            ->with('bookings', $bookings)->with('booking_total', json_encode($array1));
        //dd($months);
    }
}
