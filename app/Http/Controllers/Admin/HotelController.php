<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\HotelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HotelRequest;
use App\Imports\Admin\HotelImport;
use App\Models\Admin\CategoryModel;
use App\Models\Admin\CountryModel;
use App\Models\Admin\HotelModel;
use App\Models\Admin\ProvinceModel;
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

    public function __construct(HotelRepository $hotelRepo, ProvinceRepository $provinceRepo,CountryRepository $countryRepo, CategoryRepository $categoryRepo)
    {
        $this->middleware('auth:admin');
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

    public function getProvinces(Request $request)
    {
        if ($request->ajax()) {
            $country = $this->countryRepo->find($request->country_id);
            $provinces = $country->provinces;
            return response()->json($provinces);
        }

    }

    public function getHotelInProvince(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $province = $this->provinceRepo->find($request->province);
        $hotels = $province->hotels;
        return view('admin.contents.hotel.index', ['countries' => $countries], ['hotels' => $hotels]);

    }

    public function create()
    {
        $countries = $this->countryRepo->getAll();
        $categories = $this->categoryRepo->getAll();
        return view('admin.contents.hotel.submit', ['countries' => $countries], ['categories' => $categories]);
    }

    public function edit($id)
    {
        $categories = $this->categoryRepo->getAll();
        $hotel = $this->hotelRepo->find($id);

        return view('admin.contents.hotel.edit', ['categories' => $categories], ['hotel' => $hotel]);
    }

    public function store(HotelRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();
        $hotel = $this->hotelRepo->create($data);

        return redirect()->route('admin.hotel');
    }

    public function update(HotelRequest $request, $id)
    {
        $validated = $request->validated();
        $data = $request->all();
        $hotel = $this->hotelRepo->update($id, $data);

        return redirect()->route('admin.hotel');
    }

    public function destroy($id)
    {
        $this->hotelRepo->delete($id);
        return redirect()->route('admin.hotel');
    }

    public function search(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $keyword = $request->input('search');
        $hotels = HotelModel::SearchByKeyword($keyword, true)->paginate(10);
        return view('admin.contents.hotel.index', ['countries' => $countries], ['hotels' => $hotels]);
    }

    public function upload()
    {
        return view('admin.content.partner.upload');
    }

    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'select_file' => 'required|mimes:xls,xlsx,csv'
        ]);

        $import = Excel::import(new HotelImport(), request()->file('select_file'));
        return redirect()->route('admin.hotel');
    }

    public function export()
    {
        return Excel::download(new HotelExport(), 'hotels.xlsx');

    }
}

