<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\RoomFacilityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoomFacilityController extends Controller
{
    protected $roomFacilityRepo;

    /**
     * RoomFacilityController constructor.
     * @param RoomFacilityRepository $roomFacilityRepo
     */
    public function __construct(RoomFacilityRepository $roomFacilityRepo)
    {
        $this->roomFacilityRepo = $roomFacilityRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.contents.room_facility.submit');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'room_id',
        ]);
        $dataInsert['room_facility_id'] = json_encode($input['room_facility_id']);
        $dataInsert['description'] = isset($input['description']) ? $input['description'] : "";
        $this->roomFacilityRepo->create($dataInsert);
        return redirect()->route('admin.room.list');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'room_id'
        ]);
        $dataInsert['room_facility_id'] = json_encode($input['room_facility_id']);
        $dataInsert['description'] = isset($input['description']) ? $input['description'] : "";
        $this->roomFacilityRepo->update($id, $dataInsert);
        return redirect()->route('admin.room.list');
    }

}
