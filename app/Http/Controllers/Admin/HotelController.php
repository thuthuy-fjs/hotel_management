<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HotelRequest;
use App\Models\Admin\CountryModel;
use App\Models\Admin\ProvinceModel;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\HotelRepositoryInterface;
use App\Repositories\Admin\ProvinceRepository;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $hotelRepo;
    protected $provinceRepo;

    public function __construct(HotelRepository $hotelRepo, ProvinceRepository $provinceRepo)
    {
        $this->middleware('auth:admin');
        $this->hotelRepo = $hotelRepo;
        $this->provinceRepo = $provinceRepo;
    }

    public function index(Request $request)
    {
        $countries = CountryModel::all();
        $hotels = $this->hotelRepo->getAll();
        return view('admin.contents.hotel.index', ['countries' => $countries], ['hotels' => $hotels]);
    }

    public function getProvinces(Request $request)
    {
        if ($request->ajax()) {
            $country = CountryModel::find($request->country_id);
            $provinces = $country->provinces;
            return response()->json($provinces);
        }

    }

    public function create(Request $request)
    {
        $countries = CountryModel::all();
        $provinces = $this->provinceRepo->getProvinceFromCountry($request->country);

        return view('admin.contents.hotel.submit',['countries' => $countries]);
    }

    public function edit($id)
    {
        $countries = CountryModel::all();
        $hotel = $this->hotelRepo->find($id);

        return view('admin.contents.hotel.edit', ['countries' => $countries], ['hotel' => $hotel]);
    }

    public function delete($id)
    {
        $hotel = $this->hotelRepo->find($id);
        return view('admin.contents.hotel.delete', ['hotel' => $hotel]);
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
}
