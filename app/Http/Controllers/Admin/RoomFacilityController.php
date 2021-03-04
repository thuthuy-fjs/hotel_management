<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\RoomFacilityModel;
use Illuminate\Http\Request;

class RoomFacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
        return view('admin.contents.room_facility.submit');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $facilities = $input['room_facility_id'];
        foreach ($facilities as $facility) {
            $room_facility = new RoomFacilityModel();
            $room_facility->room_id = $input['room_id'];
            $room_facility->room_facility_id = $facility;
            $room_facility->description = isset($input['description']) ? $input['description'] : "";
            $room_facility->save();
        }

        return redirect()->route('admin.room.list');
    }
}
