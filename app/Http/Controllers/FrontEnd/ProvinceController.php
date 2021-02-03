<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        return view('frontend.contents.rooms.detail');
    }
}
