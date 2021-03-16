<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin\HotelModel;
use App\Models\Admin\RoomModel;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $provinceRepo;
    protected $categoryRepo;
    protected $countryRepo;
    protected $hotelRepo;

    /**
     * SearchController constructor.
     * @param ProvinceRepository $provinceRepo
     * @param CategoryRepository $categoryRepo
     * @param CountryRepository $countryRepo
     * @param HotelRepository $hotelRepo
     */
    public function __construct(
        ProvinceRepository $provinceRepo,
        CategoryRepository $categoryRepo,
        CountryRepository $countryRepo,
        HotelRepository $hotelRepo)
    {
        $this->provinceRepo = $provinceRepo;
        $this->categoryRepo = $categoryRepo;
        $this->countryRepo = $countryRepo;
        $this->hotelRepo = $hotelRepo;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchByCountry($id)
    {
        $country = $this->countryRepo->find($id);
        return view('frontend.contents.search.searchbycountry', ['country' => $country]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function searchByProvince(Request $request, $id)
    {
        $province_name = $this->provinceRepo->find($id);
        $provinces = $this->provinceRepo->getAll();
        $check_in_date = $request->input('check_in_date');
        $check_out_date = $request->input('check_out_date');
        $person_number = $request->input('person_number');

        return view('frontend.contents.search.searchbyprovince')
            ->with('province_name', $province_name)->with('provinces', $provinces)
            ->with('check_in_date', $check_in_date)
            ->with('check_out_date', $check_out_date)->with('person_number', $person_number);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function searchByCategory(Request $request, $id)
    {
        $category = $this->categoryRepo->find($id);
        $provinces = $this->provinceRepo->getAll();
        $province = $request->input('province');
        $province_name = $this->provinceRepo->find($province);
        $check_in_date = $request->input('check_in_date');
        $check_out_date = $request->input('check_out_date');
        $person_number = $request->input('person_number');
        return view('frontend.contents.search.searchbycategory')
            ->with('category', $category)->with('provinces', $provinces)
            ->with('province_name', $province_name)->with('provinces', $provinces)
            ->with('check_in_date', $check_in_date)
            ->with('check_out_date', $check_out_date)->with('person_number', $person_number);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $hotels = null;
        $province = $request->input('province');
        $check_in_date = Carbon::parse($request->input('check_in_date'))->toDateString();
        $check_out_date = Carbon::parse($request->input('check_out_date'))->toDateString();
        $person_number = $request->input('person_number');
        if ($request->filled(['province', 'check_in_date', 'check_out_date', 'person_number'])) {
            $times = [$check_in_date, $check_out_date,];
            $hotels = $this->hotelRepo->getHotel($province, $times, $person_number, true);
        }
        $provinces = $this->provinceRepo->getAll();
        return view('frontend.contents.search.index')
            ->with('provinces', $provinces)->with('hotels', $hotels)
            ->with('province_name', $province)->with('check_in_date', $request->input('check_in_date'))
            ->with('check_out_date', $request->input('check_out_date'))->with('person_number', $person_number);
    }
}
