<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProvinceRequest;
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
        $this->provinceRepo = $provinceRepo;
        $this->countryRepo = $countryRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $countries = $this->countryRepo->getAll();
        $provinces = $this->provinceRepo->getAll();
        return view('admin.contents.province.index', ['countries' => $countries], ['provinces' => $provinces]);
    }

    public function getProvinces(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $provinces = $this->countryRepo->find($request->country)->provinces;
        return view('admin.contents.province.index', ['countries' => $countries], ['provinces' => $provinces]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $countries = $this->countryRepo->getAll();
        return view('admin.contents.province.submit', ['countries' => $countries]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function edit($id)
    {
        $countries = $this->countryRepo->getAll();
        $province = $this->provinceRepo->find($id);
        return view('admin.contents.province.edit', ['countries' => $countries], ['province' => $province]);
    }

    /**
     * @param ProvinceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProvinceRequest $request)
    {
        $data = $request->all();
        $this->provinceRepo->create($data);
        return redirect()->route('admin.province');
    }

    /**
     * @param ProvinceRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProvinceRequest $request, $id)
    {
        $data = $request->all();
        $this->provinceRepo->update($id, $data);
        return redirect()->route('admin.province');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->provinceRepo->delete($id);
        return redirect()->route('admin.province');
    }
}
