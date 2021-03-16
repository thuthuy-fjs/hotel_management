<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\RoomExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileRequest;
use App\Http\Requests\Admin\RoomRequest;
use App\Imports\Admin\RoomImport;
use App\Models\Admin\FacilityModel;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\FacilityRepository;
use App\Repositories\Admin\HotelRepository;
use App\Repositories\Admin\ProvinceRepository;
use App\Repositories\Admin\RoomFacilityRepository;
use App\Repositories\Admin\RoomRepository;
use App\Repositories\Admin\RoomTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class RoomController extends Controller
{
    protected $roomRepo;
    protected $hotelRepo;
    protected $roomtypeRepo;
    protected $countryRepo;
    protected $provinceRepo;
    protected $facilityRepo;

    /**
     * RoomController constructor.
     * @param RoomRepository $roomRepo
     * @param HotelRepository $hotelRepo
     * @param RoomTypeRepository $roomtypeRepo
     * @param ProvinceRepository $provinceRepo
     * @param CountryRepository $countryRepo
     * @param FacilityRepository $facilityRepo
     */
    public function __construct(
        RoomRepository $roomRepo,
        HotelRepository $hotelRepo,
        RoomTypeRepository $roomtypeRepo,
        ProvinceRepository $provinceRepo,
        CountryRepository $countryRepo,
        FacilityRepository $facilityRepo)
    {
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->roomtypeRepo = $roomtypeRepo;
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
        $this->facilityRepo = $facilityRepo;
    }

    /**
     * return all rooms exist
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rooms = $this->roomRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        $countries = $this->countryRepo->getAll();
        return view('admin.contents.room.index', ['rooms' => $rooms], ['hotels' => $hotels])
            ->with('countries', $countries);
    }

    /**
     * show information of rooms
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $room = $this->roomRepo->find($id);
        return view('admin.contents.room.show', ['room' => $room]);
    }

    /**
     * return all hotel rooms
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRoomInHotel(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        $hotel = $this->hotelRepo->find($request->hotel);
        $rooms = $hotel->rooms;
        return view('admin.contents.room.index',
            ['hotels' => $hotels], ['rooms' => $rooms])
            ->with('countries', $countries);

    }

    /**
     * redirect to the new room creation page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $hotels = $this->hotelRepo->getAll();
        $types = $this->roomtypeRepo->getAll();
        return view('admin.contents.room.submit')->with('hotels', $hotels)->with('types', $types);
    }

    /**
     * redirect to the room edit page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $types = $this->roomtypeRepo->getAll();
        $room = $this->roomRepo->find($id);
        return view('admin.contents.room.edit')->with('room', $room)->with('types', $types);
    }

    /**
     * add the new room
     * @param RoomRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(RoomRequest $request)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'hotel_id',
            'room_type_id',
            'room_name',
            'room_price'
        ]);
        $dataInsert['room_images'] = json_encode($input['room_images']);
        $room = $this->roomRepo->create($dataInsert);
        $facilities = $this->facilityRepo->getAll();

        return view('admin.contents.room_facility.submit', ['room' => $room], ['facilities' => $facilities]);
    }

    /**
     * update information of the room
     * @param RoomRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(RoomRequest $request, $id)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'hotel_id',
            'room_type_id',
            'room_name',
            'room_price'
        ]);
        $dataInsert['room_images'] = json_encode($input['room_images']);
        $room = $this->roomRepo->update($id, $dataInsert);
        $facilities = $this->facilityRepo->getAll();
        foreach ($facilities as $key => $facility) {
            foreach ($room->facilities as $room_facility) {
                if ($facility->id == $room_facility->room_facility_id) {
                    unset($facilities[$key]);
                }
            }
        }
        return redirect()->route('admin.room.list');
        //return view('admin.contents.room_facility.edit', ['room' => $room], ['facilities' => $facilities]);
    }

    /**
     * delete room
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->roomRepo->delete($id);
        return redirect()->route('admin.room.list');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $countries = $this->countryRepo->getAll();
        $keyword = $request->input('search');
        $rooms = $this->roomRepo->search($keyword);
        return view('admin.contents.room.index', ['countries' => $countries], ['rooms' => $rooms]);
    }

    /**
     * import room list
     * @param FileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(FileRequest $request)
    {
        Excel::import(new RoomImport(), $request->file('select_file'));
        return redirect()->route('admin.hotel');
    }

    /**
     * export room list
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new RoomExport(), 'rooms.xlsx');

    }
}
