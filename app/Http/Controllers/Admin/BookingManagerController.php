<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\BookingModel;
use App\Repositories\Frontend\BookingRepository;
use Illuminate\Http\Request;

class BookingManagerController extends Controller
{
    protected $bookingRepo;

    public function __construct(BookingRepository $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $bookings = $this->bookingRepo->paginate(10);
        return view('admin.contents.booking.index')->with('bookings', $bookings);
    }
}
