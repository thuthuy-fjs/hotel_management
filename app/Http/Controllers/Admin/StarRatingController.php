<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\StarRatingRepository;
use Illuminate\Http\Request;

class StarRatingController extends Controller
{
    protected $starRatingRepo;

    public function __construct(StarRatingRepository $starRatingRepo)
    {
        $this->starRatingRepo = $starRatingRepo;
    }

    public function index()
    {
        $star_ratings = $this->starRatingRepo->paginate(10);
        return view('admin.contents.star_rating.index')->with('star_ratings', $star_ratings);
    }

    public function destroy($id)
    {
        $this->starRatingRepo->delete($id);
        return redirect()->route('admin.star_rating');
    }
}
