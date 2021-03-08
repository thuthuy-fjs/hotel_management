<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\GuestExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\GuestRequest;
use App\Imports\Admin\GuestImport;
use App\Models\Frontend\GuestModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $guests = GuestModel::all();
        return view('admin.contents.guest.index')->with('guests', $guests);
    }

    public function create()
    {
        return view('admin.contents.guest.submit');
    }

    public function edit($id)
    {
        $guest = GuestModel::find($id);
        return view('admin.contents.guest.edit')->with('guest', $guest);
    }

    public function store(GuestRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $guest = new GuestModel();
        $guest->first_name = $input['first_name'];
        $guest->last_name = $input['last_name'];
        $guest->user_name = $input['user_name'];
        $guest->email = $input['email'];
        $guest->password = bcrypt($input['password']);
        $guest->phone = $input['phone'];
        $guest->address = $input['address'];
        $guest->image = $input['image'];
        $guest->save();
        return redirect()->route('admin.guest');
    }

    public function update(GuestRequest $request, $id)
    {
        $validated = $request->validated();
        $input = $request->all();

        $validated = $request->validated();
        $input = $request->all();
        $guest = GuestModel::find($id);
        $guest->first_name = $input['first_name'];
        $guest->last_name = $input['last_name'];
        $guest->user_name = $input['user_name'];
        $guest->email = $input['email'];
        $guest->password = bcrypt($input['password']);
        $guest->phone = $input['phone'];
        $guest->address = $input['address'];
        $guest->image = $input['image'];
        $guest->save();
        return redirect()->route('admin.guest');
    }

    public function destroy($id)
    {
        $guest = GuestModel::find($id);
        $guest->delete();
        return redirect()->route('admin.guest');
    }

    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'select_file' => 'required|mimes:xls,xlsx,csv'
        ]);

        $import = Excel::import(new GuestImport(), request()->file('select_file'));
        return redirect()->route('admin.hotel');
    }

    public function export()
    {
        return Excel::download(new GuestExport(), 'guests.xlsx');

    }
}
