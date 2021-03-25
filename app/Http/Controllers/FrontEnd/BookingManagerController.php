<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\BookingRepository;
use App\Repositories\Frontend\StarRatingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingManagerController extends Controller
{
    protected $bookingRepo;
    protected $starRepo;


    public function __construct(
        BookingRepository $bookingRepo,
        StarRatingRepository $starRepo)
    {
        $this->bookingRepo = $bookingRepo;
        $this->starRepo = $starRepo;
    }

    public function getBooking()
    {
        $bookings = $this->bookingRepo->findBy('guest_id', Auth::id(), 10);
        $complete_bookings = $this->bookingRepo->getCompleteBooking(Auth::id(),
            Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'), 10);
        $incomplete_bookings = $this->bookingRepo->getIncompleteBooking(Auth::id(),
            Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'), 10);
        $star_ratings = $this->starRepo->findBy('guest_id', Auth::id(), 10);
        return view('frontend.contents.booking.detail')
            ->with('bookings', $bookings)->with('star_ratings', $star_ratings)
            ->with('complete_bookings', $complete_bookings)->with('incomplete_bookings', $incomplete_bookings);
    }
}
