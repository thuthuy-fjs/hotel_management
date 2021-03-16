<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\StarRatingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
