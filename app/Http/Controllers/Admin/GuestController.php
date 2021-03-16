<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\GuestExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileRequest;
use App\Http\Requests\Frontend\GuestRequest;
use App\Imports\Admin\GuestImport;
use App\Repositories\Frontend\GuestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class GuestController extends Controller
{
    protected $guestRepo;

    public function __construct(GuestRepository $guestRepo)
    {
        $this->guestRepo = $guestRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $guests = $this->guestRepo->paginate(10);
        return view('admin.contents.guest.index')->with('guests', $guests);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.contents.guest.submit');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $guest =  $this->guestRepo->find($id);
        return view('admin.contents.guest.edit')->with('guest', $guest);
    }

    /**
     * @param GuestRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GuestRequest $request)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'first_name',
            'last_name',
            'user_name',
            'email',
            'phone',
            'address',
            'image',
        ]);
        $dataInsert['password'] = bcrypt($input['password']);
        $this->guestRepo->create($dataInsert);
        return redirect()->route('admin.guest');
    }

    /**
     * @param GuestRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GuestRequest $request, $id)
    {
        $input = $request->all();
        $dataInsert = Arr::only($input, [
            'first_name',
            'last_name',
            'user_name',
            'email',
            'phone',
            'address',
            'image',
        ]);
        $dataInsert['password'] = bcrypt($input['password']);
        $this->guestRepo->update($id, $dataInsert);
        return redirect()->route('admin.guest');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->guestRepo->delete($id);
        return redirect()->route('admin.guest');
    }

    /**
     * @param FileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(FileRequest $request)
    {
        Excel::import(new GuestImport(), $request->file('select_file'));
        return redirect()->route('admin.hotel');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new GuestExport(), 'guests.xlsx');

    }
}
