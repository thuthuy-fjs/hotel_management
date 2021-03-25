<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\StarRatingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StarRatingController extends Controller
{
    protected $starRepo;

    /**
     * StarRatingController constructor.
     * @param StarRatingRepository $starRepo
     */
    public function __construct(StarRatingRepository $starRepo)
    {
        $this->starRepo = $starRepo;
    }

    public function index()
    {
        $guest = Auth::user();
        $star_ratings = $this->starRepo->findBy('guest_id', Auth::id(), 10);
        return view('frontend.contents.stars.index')
            ->with('star_ratings', $star_ratings)->with('guest', $guest);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'guest_id',
            'booking_id',
            'description'
        ]);
        $dataInsert['level'] = $input['level'][0];
        $this->starRepo->create($dataInsert);
        return redirect()->back();
    }
}
