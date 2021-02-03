<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\ProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    protected $provinceRepo;
    protected $countryRepo;

    public function __construct(ProvinceRepository $provinceRepo, CountryRepository $countryRepo)
    {
        $this->middleware('auth:admin');
        $this->provinceRepo = $provinceRepo;
        $this->countryRepo = $countryRepo;
    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        $provinces = $this->provinceRepo->getAll();
        return view('admin.contents.province.index', ['countries' => $countries], ['provinces' => $provinces]);
    }

    public function create()
    {
        $countries = $this->countryRepo->getAll();
        return view('admin.contents.province.submit', ['countries' => $countries]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        $data = $request->all();
        $hotel = $this->provinceRepo->create($data);

        return redirect()->route('admin.province');
    }
}
