<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\RoomTypeRepository;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $roomTypeRepo;

    /**
     * RoomTypeController constructor.
     * @param RoomTypeRepository $roomTypeRepo
     */
    public function __construct(RoomTypeRepository $roomTypeRepo)
    {
        $this->roomTypeRepo = $roomTypeRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $types = $this->roomTypeRepo->paginate(10);
        return view('admin.contents.roomtype.index', ['types' => $types]);
    }
}
