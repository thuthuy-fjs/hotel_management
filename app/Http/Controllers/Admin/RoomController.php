<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;
use App\Models\Admin\FacilityModel;
use App\Models\Admin\RoomFacilityModel;
use App\Models\Admin\RoomModel;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Admin\RoomTypeRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RoomController extends Controller
{
    protected $roomRepo;
    protected $hotelRepo;
    protected $roomtypeRepo;

    public function __construct(RoomRepository $roomRepo, HotelRepository $hotelRepo, RoomTypeRepository $roomtypeRepo)
    {
        $this->middleware('auth:admin');
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->roomtypeRepo = $roomtypeRepo;
    }

    public function index()
    {
        $rooms = $this->roomRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        return view('admin.contents.room.index', ['rooms' => $rooms], ['hotels' => $hotels]);
    }

    public function show($id)
    {
        $room = $this->roomRepo->find($id);
        return view('admin.contents.room.show', ['room' => $room]);
    }

    public function getRoomInHotel(Request $request)
    {
        $hotels = $this->hotelRepo->getAll();
        $hotel = $this->hotelRepo->find($request->hotel);
        $rooms = $hotel->rooms;
        return view('admin.contents.room.index', ['hotels' => $hotels], ['rooms' => $rooms]);

    }

    public function create()
    {
        $hotels = $this->hotelRepo->getAll();
        $types = $this->roomtypeRepo->getAll();
        return view('admin.contents.room.submit')->with('hotels', $hotels)->with('types', $types);
    }

    public function edit($id)
    {
        $types = $this->roomtypeRepo->getAll();
        $room = $this->roomRepo->find($id);
        return view('admin.contents.room.edit')->with('room', $room)->with('types', $types);
    }

    public function store(RoomRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $room = new RoomModel();
        $room->hotel_id = $input['hotel_id'];
        $room->room_type_id = $input['room_type_id'];
        $room->room_name = $input['room_name'];
        $room->room_price = $input['room_price'];
        $room->room_images = json_encode($input['room_images']);
        //$room->save();
        $facilities = FacilityModel::all();

        return view('admin.contents.room_facility.submit', ['room' => $room], ['facilities' => $facilities]);
    }

    public function update(RoomRequest $request, $id)
    {
        $validated = $request->validated();
        $input = $request->all();

        $room = RoomModel::find($id);
        $room->hotel_id = $input['hotel_id'];
        $room->room_type_id = $input['room_type_id'];
        $room->room_name = $input['room_name'];
        $room->room_price = $input['room_price'];
        $room->room_images = json_encode($input['room_images']);
        $room->save();

        return view('admin.contents.room_facility.submit', ['room' => $room]);
    }

    public function destroy($id)
    {
        $this->roomRepo->delete($id);
        return redirect()->route('admin.room.list');
    }

    public function search(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $keyword = $request->input('search');
        $rooms = RoomModel::SearchByKeyword($keyword, true)->paginate(10);
        return view('admin.contents.room.index', ['countries' => $countries], ['rooms' => $rooms]);
    }

    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'select_file' => 'required|mimes:xls,xlsx,csv'
        ]);

        $import = Excel::import(new HotelImport(), request()->file('select_file'));
        return redirect()->route('admin.hotel');
    }

    public function export()
    {
        return Excel::download(new HotelExport(), 'hotels.xlsx');

    }
}
