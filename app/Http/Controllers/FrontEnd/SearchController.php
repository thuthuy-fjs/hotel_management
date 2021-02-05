<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\ProvinceRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $provinceRepo;
    protected $categoryRepo;
    protected $countryRepo;

    public function __construct(ProvinceRepository $provinceRepo, CategoryRepository $categoryRepo, CountryRepository $countryRepo)
    {
        $this->provinceRepo = $provinceRepo;
        $this->categoryRepo = $categoryRepo;
        $this->countryRepo = $countryRepo;
    }

    public function search()
    {
        return view('frontend.contents.search.index');
    }

    public function searchByCountry($id)
    {
        $country = $this->countryRepo->find($id);
        return view('frontend.contents.search.searchbycountry', ['country' => $country]);
    }

    public function searchByProvince($id)
    {
        $province = $this->provinceRepo->find($id);
        return view('frontend.contents.search.searchbyprovince', ['province' => $province]);
    }

    public function searchByCategory($id)
    {
        $category = $this->categoryRepo->find($id);
        return view('frontend.contents.search.searchbycategory', ['category' => $category]);
    }
}
