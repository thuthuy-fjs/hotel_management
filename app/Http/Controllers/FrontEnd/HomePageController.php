<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Admin\RoomTypeRepository;
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
}
