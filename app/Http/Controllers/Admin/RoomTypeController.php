<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\RoomTypeRepository;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $roomTypeRepo;
    public function __construct(RoomTypeRepository $roomTypeRepo)
    {
        $this->middleware('auth:admin');
        $this->roomTypeRepo = $roomTypeRepo;
    }

    public function index(){
        $types = $this->roomTypeRepo->getAll();
        return view('admin.contents.roomtype.index', ['types' => $types]);
    }
}
