<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;
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
        return view('admin.contents.room.submit', ['hotels' => $hotels], ['types' => $types]);
    }

    public function edit($id)
    {
        $types = $this->roomtypeRepo->getAll();
        $hotel = $this->hotelRepo->find($id);
        return view('admin.contents.room.edit', ['types' => $types], ['hotel' => $hotel]);
    }

    public function store(RoomRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();
        $hotel = $this->hotelRepo->create($data);

        return redirect()->route('admin.room.image.create');
    }

    public function update(RoomRequest $request, $id)
    {
        $validated = $request->validated();
        $data = $request->all();
        $hotel = $this->hotelRepo->update($id, $data);

        return redirect()->route('admin.hotel');
    }

    public function destroy($id)
    {
        $this->hotelRepo->delete($id);
        return redirect()->route('admin.hotel');
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
