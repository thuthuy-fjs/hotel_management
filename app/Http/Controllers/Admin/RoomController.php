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
    protected $roomFacilityRepo;


    public function __construct(
        RoomRepository $roomRepo,
        HotelRepository $hotelRepo,
        RoomTypeRepository $roomtypeRepo,
        ProvinceRepository $provinceRepo,
        CountryRepository $countryRepo,
        FacilityRepository $facilityRepo,
        RoomFacilityRepository $roomFacilityRepo)
    {
        $this->roomRepo = $roomRepo;
        $this->hotelRepo = $hotelRepo;
        $this->roomtypeRepo = $roomtypeRepo;
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
        $this->facilityRepo = $facilityRepo;
        $this->roomFacilityRepo = $roomFacilityRepo;
    }

    /**
     * return all rooms exist
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rooms = $this->roomRepo->paginate(10);
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
        $rooms = $this->roomRepo->findBy('hotel_id', $request->hotel, 10);
        return view('admin.contents.room.index',
            ['hotels' => $hotels], ['rooms' => $rooms])
            ->with('countries', $countries);

    }

    public function getRooms($id)
    {
        $countries = $this->countryRepo->getAll();
        $hotels = $this->hotelRepo->getAll();
        $rooms = $this->roomRepo->findBy('hotel_id', $id, 10);
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
        $room_facility = $this->roomFacilityRepo->findByRoom($id);
        if (isset($room_facility)) {
            $facilities = $this->facilityRepo->getAll();
            $room_facilities = $room_facility->room_facility_id ?
                json_decode($room_facility->room_facility_id) : array();
            foreach ($facilities as $key => $facility) {
                foreach ($room_facilities as $key2 => $roomfacility) {
                    if ($facility->id == $roomfacility) {
                        unset($facilities[$key]);
                    }
                }
            }
            $un_facilities = $facilities;
            $facilities = $this->facilityRepo->getAll();
            return view('admin.contents.room_facility.edit')->with('room', $room)
                ->with('room_facility', $room_facility)->with('facilities', $facilities)
                ->with('room_facilities', $room_facilities)->with('un_facilities', $un_facilities);
        } else {
            $facilities = $this->facilityRepo->getAll();
            return view('admin.contents.room_facility.submit', ['room' => $room], ['facilities' => $facilities]);
        }
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
        $import_room = new RoomImport();
        $import_room->import($request->file('select_file'));
        if ($import_room->failures()->isNotEmpty()) {
            $failures = $import_room->failures();
            return redirect()->route('admin.room.list')->withFailures($failures);
        }
        return redirect()->route('admin.room.list')->with('success', 'Upload file thành công!');
    }

    /**
     * export room list
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export($id)
    {
        return Excel::download(new RoomExport($id), 'rooms.xlsx');

    }
}
