<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{    
    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $rooms = Room::orderBy('id', 'Asc');

        if (!empty($request->searchcode))
        {
            $rooms = $rooms->where('code_rooms', 'LIKE', '%' . $request->searchcode . '%');
        }

        if (!empty($request->searchname))
        {
            $rooms = $rooms->where('name', 'LIKE', '%' . $request->searchname . '%');
        }

        $rooms = $rooms->paginate(10);

        return view('admin.room.index', compact('rooms'));
    }

    public function create(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        $type = array(
            'Kelas'        => 'Kelas',
            'Laboratorium' => 'Laboratorium');

        return view('admin.room.create', compact('type'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            // 'code_rooms' => 'unique:rooms,code_rooms|required',
            'namerooms'  => 'required',
            'capacity'   => 'required',

        ]);

        $params = [
            'code_rooms' => date('dmyhis').rand(0,9999),
            'name'       => $request->input('namerooms'),
            'capacity'   => $request->input('capacity'),
            'type'       => $request->input('type'),
        ];

        $rooms = Room::create($params);

        return redirect()->route('admin.rooms');
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $rooms = Room::find($id);

        if ($rooms == null)
        {
            return view('admin.layouts.404');
        }

        $type = array(
            'Kelas'        => 'Kelas',
            'Laboratorium' => 'Laboratorium');

        return view('admin.room.edit', compact('rooms', 'type'));
    }

    public function update(Request $request, $id)
    {
        $role = Auth::user()->role;
        Checking::check($role);


        $this->validate($request, [
            // 'code_rooms' => 'unique:rooms,code_rooms,' . $id . '|required',
            'namerooms'  => 'required',
            'capacity'   => 'required',

        ]);

        $rooms             = Room::find($id);
        $rooms->code_rooms = now().rand(0,9999);
        $rooms->name       = $request->input('namerooms');
        $rooms->capacity   = $request->input('capacity');
        $rooms->type       = $request->input('type');
        $rooms->save();

        return redirect()->route('admin.rooms');
    }

    public function destroy($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        
        Room::find($id)->delete();

        return redirect()->route('admin.rooms')->with('success', 'Ruangan berhasil dihapus');
    }
}
