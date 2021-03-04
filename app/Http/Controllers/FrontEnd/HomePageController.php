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

class HomePageController extends Controller
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

    public function index()
    {
        $provinces = $this->provinceRepo->getAll();
        $categories = $this->categoryRepo->getAll();
        $countries = $this->countryRepo->getAll();
        return view('frontend.dashboard')->with('provinces', $provinces)->with('categories', $categories)->with('countries', $countries);
    }

    public function search(Request $request)
    {
        $hotels = null;
        $province = $request->input('province');
        $check_in_date = Carbon::parse($request->input('check_in_date'))->toDateString();
        $check_out_date = Carbon::parse($request->input('check_out_date'))->toDateString();
        $person_number = $request->input('person_number');
        if ($request->filled(['province', 'check_in_date', 'check_out_date'])) {
            $times = [$check_in_date, $check_out_date,];
            $hotels = HotelModel::filters($province, $times, true)->get();
        }
        $provinces = $this->provinceRepo->getAll();
        return view('frontend.contents.search.index')
            ->with('provinces', $provinces)->with('hotels', $hotels)
            ->with('province_name', $province)->with('check_in_date', $request->input('check_in_date'))
            ->with('check_out_date', $request->input('check_out_date'))->with('person_number', $person_number);
    }
}
