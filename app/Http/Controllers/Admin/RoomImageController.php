<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FacilityModel;
use App\Repositories\Admin\RoomFacilityRepository;
use App\Repositories\Admin\RoomImageRepository;
use Illuminate\Http\Request;

class RoomImageController extends Controller
{
    protected $roomImageRepo;
    protected $roomFacilityRepo;

    public function __construct(RoomImageRepository $roomImageRepo, RoomFacilityRepository $roomFacilityRepo)
    {
        $this->middleware('auth:admin');
        $this->roomImageRepo = $roomImageRepo;
        $this->roomFacilityRepo = $roomFacilityRepo;
    }

    public function create()
    {
        return view('admin.contents.room_facility.submit');
    }

    public function store(Request $request)
    {
        //$validated = $request->validated();
        $data = $request->all();
        $roomImg = $this->roomImageRepo->create($data);
        $roomFacility = $this->roomFacilityRepo->create($data);

        return redirect()->route('admin.room.list');
    }
}
