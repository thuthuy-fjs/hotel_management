<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    protected $countryRepo;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->middleware('auth:admin');
        $this->countryRepo = $countryRepo;
    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        return view('admin.contents.country.index', ['countries' => $countries]);
    }

    public function create()
    {
        return view('admin.contents.country.submit');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_name' => 'required|max:255',
        ]);
        $data = $request->all();
        $hotel = $this->countryRepo->create($data);

        return redirect()->route('admin.country');
    }
}
