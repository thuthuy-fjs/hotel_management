<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\FacilityRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Frontend\BookingRepository;
use App\Repositories\Frontend\PaymentRepository;
use App\Repositories\Frontend\StarRatingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    protected $roomRepo;
    protected $hotelRepo;
    protected $paymentRepo;
    protected $categoryRepo;
    protected $countryRepo;
    protected $starRepo;
    protected $provinceRepo;
    protected $facilityRepo;
    protected $bookingRepo;

    /**
     * HotelController constructor.
     * @param RoomRepository $roomRepo
     * @param HotelRepository $hotelRepo
     * @param PaymentRepository $paymentRepo
     * @param CategoryRepository $categoryRepo
     * @param CountryRepository $countryRepo
     * @param ProvinceRepository $provinceRepo
     * @param StarRatingRepository $starRepo
     * @param FacilityRepository $facilityRepo
     * @param BookingRepository $bookingRepo
     */
    public function __construct(
        RoomRepository $roomRepo,
        HotelRepository $hotelRepo,
        PaymentRepository $paymentRepo,
        CategoryRepository $categoryRepo,
        CountryRepository $countryRepo,
        ProvinceRepository $provinceRepo,
        StarRatingRepository $starRepo,
        FacilityRepository $facilityRepo,
        BookingRepository $bookingRepo)
    {
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->paymentRepo = $paymentRepo;
        $this->categoryRepo = $categoryRepo;
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
        $this->starRepo = $starRepo;
        $this->facilityRepo = $facilityRepo;
        $this->bookingRepo = $bookingRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function hotel(Request $request)
    {
        $id = $request->id;
        $facilities = $this->facilityRepo->getAll();
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
        $bookings = [];
        if ($request->filled(['province', 'check_in_date', 'check_out_date', 'person_number'])) {
            $rooms = $this->roomRepo->getRoom($id, $person_number, $times);
            $bookings = $this->bookingRepo->getBooking($times);
        }

        return view('frontend.contents.hotels.detail')
            ->with('provinces', $provinces)->with('hotel', $hotel)
            ->with('province_name', $province)->with('check_in_date', $check_in_date)
            ->with('check_out_date', $check_out_date)->with('person_number', $person_number)
            ->with('star_ratings', $star_ratings)->with('guest', $guest)
            ->with('rooms', $rooms)->with('facilities', $facilities)
            ->with('bookings', $bookings);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function booking(Request $request)
    {
        $input = $request->all();
        $ids = $input['room_id'];
        $room_ids = explode(', ', $ids);
        $number_room = explode(', ', $input['number_room']);
        $total_price = $input['total_price'];
        $check_in_date = $input['check_in_date'];
        $check_out_date = $input['check_out_date'];
        $person_number = $input['person_number'];
        $rooms = [];
        foreach ($room_ids as $key => $id) {
            $rooms[$key] = $this->roomRepo->find($id);
        }
        $payments = $this->paymentRepo->getAll();
        return view('frontend.contents.booking.index')
            ->with('rooms', $rooms)->with('check_in_date', $check_in_date)
            ->with('check_out_date', $check_out_date)->with('person_number', $person_number)
            ->with('payments', $payments)->with('total_price', $total_price)
            ->with('number_room', $number_room);
    }
}
