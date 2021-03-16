<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\HotelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileRequest;
use App\Http\Requests\Admin\HotelRequest;
use App\Imports\Admin\HotelImport;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HotelController extends Controller
{
    protected $hotelRepo;
    protected $provinceRepo;
    protected $countryRepo;
    protected $categoryRepo;

    /**
     * HotelController constructor.
     * @param HotelRepository $hotelRepo
     * @param ProvinceRepository $provinceRepo
     * @param CountryRepository $countryRepo
     * @param CategoryRepository $categoryRepo
     */
    public function __construct(
        HotelRepository $hotelRepo,
        ProvinceRepository $provinceRepo,
        CountryRepository $countryRepo,
        CategoryRepository $categoryRepo)
    {
        $this->hotelRepo = $hotelRepo;
        $this->provinceRepo = $provinceRepo;
        $this->countryRepo = $countryRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        return view('admin.contents.hotel.index', ['countries' => $countries], ['hotels' => $hotels]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProvinces(Request $request)
    {
        if ($request->ajax()) {
            $country = $this->countryRepo->find($request->country_id);
            $provinces = $country->provinces;
            return response()->json($provinces);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHotelInProvince(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $province = $this->provinceRepo->find($request->province);
        $hotels = $province->hotels;
        return view('admin.contents.hotel.index', ['countries' => $countries], ['hotels' => $hotels]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $countries = $this->countryRepo->getAll();
        $categories = $this->categoryRepo->getAll();
        return view('admin.contents.hotel.submit', ['countries' => $countries], ['categories' => $categories]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryRepo->getAll();
        $hotel = $this->hotelRepo->find($id);
        return view('admin.contents.hotel.edit', ['categories' => $categories], ['hotel' => $hotel]);
    }

    /**
     * @param HotelRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HotelRequest $request)
    {
        $data = $request->all();
        $this->hotelRepo->create($data);
        return redirect()->route('admin.hotel');
    }

    /**
     * @param HotelRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HotelRequest $request, $id)
    {
        $data = $request->all();
        $this->hotelRepo->update($id, $data);
        return redirect()->route('admin.hotel');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->hotelRepo->delete($id);
        return redirect()->route('admin.hotel');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $keyword = $request->input('search');
        $hotels = $this->hotelRepo->search($keyword, true);
        return view('admin.contents.hotel.index', ['countries' => $countries], ['hotels' => $hotels]);
    }

    /**
     * @param FileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(FileRequest $request)
    {
        Excel::import(new HotelImport(), $request->file('select_file'));
        return redirect()->route('admin.hotel');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new HotelExport(), 'hotels.xlsx');

    }
}

