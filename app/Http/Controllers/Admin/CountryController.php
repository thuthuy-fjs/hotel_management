<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Repositories\Admin\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    protected $countryRepo;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $countries = $this->countryRepo->paginate(10);
        return view('admin.contents.country.index', ['countries' => $countries]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.contents.country.submit');
    }

    public function edit($id)
    {
        $country = $this->countryRepo->find($id);
        return view('admin.contents.country.edit', ['country' => $country]);
    }

    /**
     * @param CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryRequest $request)
    {
        $data = $request->all();
        $this->countryRepo->create($data);
        return redirect()->route('admin.country');
    }

    /**
     * @param CountryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryRequest $request, $id)
    {
        $data = $request->all();
        $this->countryRepo->update($id, $data);
        return redirect()->route('admin.country');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->countryRepo->delete($id);
        return redirect()->route('admin.country');
    }
}
