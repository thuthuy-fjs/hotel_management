<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Frontend\StarRatingModel;
use App\Repositories\Frontend\StarRatingRepository;
use Illuminate\Http\Request;

class StarRatingController extends Controller
{
    protected $starRepo;

    public function __construct(StarRatingRepository $starRepo)
    {
        $this->starRepo = $starRepo;
    }
    public function comment(Request $request)
    {
        $input = $request->all();
        $star_rating = new StarRatingModel();
        $star_rating->guest_id = $input['guest_id'];
        $star_rating->booking_id = $input['booking_id'];
        $star_rating->level = $input['level'][0];
        $star_rating->description = $input['description'];
        $star_rating->save();
        return redirect()->back();
    }
}
