<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Admin\RoomTypeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelFullCalendar\Calendar;

class RoomDetailController extends Controller
{
    protected $roomRepo;
    protected $hotelRepo;
    protected $roomtypeRepo;
    protected $countryRepo;
    protected $provinceRepo;

    public function __construct(RoomRepository $roomRepo, ProvinceRepository $provinceRepo, HotelRepository $hotelRepo, RoomTypeRepository $roomtypeRepo, CountryRepository $countryRepo)
    {
        $this->middleware('auth:admin');
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->roomtypeRepo = $roomtypeRepo;
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
    }

    public function index(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        return view('admin.contents.room_detail.index')->with('countries', $countries);
    }

    public function getHotels(Request $request)
    {
        if ($request->ajax()) {
            $province = $this->provinceRepo->find($request->province_id);
            $hotels = $province->hotels;
            return response()->json($hotels);
        }
    }

    public function getRoomInHotel(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        $hotel = $this->hotelRepo->find($request->hotel);
        $rooms = $hotel->rooms;
        return view('admin.contents.room.index', ['hotels' => $hotels], ['rooms' => $rooms])->with('countries', $countries);

    }

    public function getRooms(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $hotel = $this->hotelRepo->find($request->hotel);
        $rooms = $hotel->rooms;
        $events = [];
        foreach ($rooms as $room){
            foreach ($room->bookings as $booking){
                $events[] = Calendar::event(
                    $booking->guest->user_name,
                    true,
                    Carbon::parse($booking->check_in_date)->format('d-m-Y'),
                    Carbon::parse($booking->check_out_date)->format('d-m-Y'),
                    '0'
                );
            }

        }
        $calendar = \Calendar::addEvents($events);
        return view('admin.contents.room_detail.index')
            ->with('countries', $countries)->with('calendar', $calendar);
        //dd($rooms);
    }
}
