<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin\HotelModel;
use App\Models\Admin\RoomModel;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Admin\RoomTypeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    protected $roomRepo;
    protected $hotelRepo;
    protected $roomtypeRepo;
    protected $provinceRepo;
    protected $categoryRepo;
    protected $countryRepo;

    public function __construct(RoomRepository $roomRepo, HotelRepository $hotelRepo, RoomTypeRepository $roomtypeRepo, ProvinceRepository $provinceRepo, CategoryRepository $categoryRepo, CountryRepository $countryRepo)
    {
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->roomtypeRepo = $roomtypeRepo;
        $this->provinceRepo = $provinceRepo;
        $this->categoryRepo = $categoryRepo;
        $this->countryRepo = $countryRepo;

    }

    public function hotel(Request $request)
    {
        $id = $request->id;
        $hotel = $this->hotelRepo->find($id);
        $province = $request->province;
        $check_in_date = $request->check_in_date;
        $check_out_date = $request->check_out_date;
        $person_number = $request->person_number;
        $provinces = $this->provinceRepo->getAll();
        return view('frontend.contents.hotels.detail')
            ->with('provinces', $provinces)->with('hotel', $hotel)
            ->with('province_name', $province)->with('check_in_date', $check_in_date)
            ->with('check_out_date', $check_out_date)->with('person_number', $person_number);

        //dd($check_in_date);
    }

    public function booking(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $id = $request->id;
            $room = $this->roomRepo->find($id);
            $check_in_date = $request->check_in_date;
            $check_out_date = $request->check_out_date;
            $person_number = $request->person_number;
            $guest = Auth::user();
            return view('frontend.contents.booking.index')->with('guest', $guest)
                ->with('room', $room)->with('check_in_date', $check_in_date)
                ->with('check_out_date', $check_out_date)->with('person_number', $person_number);
        } else {
            return view('frontend.auth.login');
        }
    }
}
