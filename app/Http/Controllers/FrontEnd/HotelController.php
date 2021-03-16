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
use App\Repositories\Frontend\StarRatingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPSTORM_META\type;

class HotelController extends Controller
{
    protected $roomRepo;
    protected $hotelRepo;
    protected $provinceRepo;
    protected $categoryRepo;
    protected $countryRepo;
    protected $starRepo;

    /**
     * HotelController constructor.
     * @param RoomRepository $roomRepo
     * @param HotelRepository $hotelRepo
     * @param ProvinceRepository $provinceRepo
     * @param CategoryRepository $categoryRepo
     * @param CountryRepository $countryRepo
     * @param StarRatingRepository $starRepo
     */
    public function __construct(
        RoomRepository $roomRepo,
        HotelRepository $hotelRepo,
        ProvinceRepository $provinceRepo,
        CategoryRepository $categoryRepo,
        CountryRepository $countryRepo,
        StarRatingRepository $starRepo)
    {
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->provinceRepo = $provinceRepo;
        $this->categoryRepo = $categoryRepo;
        $this->countryRepo = $countryRepo;
        $this->starRepo = $starRepo;

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function hotel(Request $request)
    {
        $id = $request->id;
        $hotel = $this->hotelRepo->find($id);
        $province = $request->province;
        $check_in_date = $request->check_in_date;
        $check_out_date = $request->check_out_date;
        $person_number = $request->person_number;
        $provinces = $this->provinceRepo->getAll();
        $star_ratings = $this->starRepo->paginate(3);
        $guest = Auth::user();
        $times = [Carbon::parse($check_in_date)->format('Y-m-d'),
                Carbon::parse($check_out_date)->format('Y-m-d'),];
        $rooms = [];
        if ($request->filled(['province', 'check_in_date', 'check_out_date', 'person_number'])) {
            $rooms = $this->roomRepo->getRoom($id, $person_number, $times);
        }
        return view('frontend.contents.hotels.detail')
            ->with('provinces', $provinces)->with('hotel', $hotel)
            ->with('province_name', $province)->with('check_in_date', $check_in_date)
            ->with('check_out_date', $check_out_date)->with('person_number', $person_number)
            ->with('star_ratings', $star_ratings)->with('guest', $guest)
            ->with('rooms', $rooms);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
