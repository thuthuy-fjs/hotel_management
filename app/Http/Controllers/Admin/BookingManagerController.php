<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\BookingModel;
use Illuminate\Http\Request;

class BookingManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $bookings = BookingModel::all();
        return view('admin.contents.booking.index')->with('bookings', $bookings);
    }
}
