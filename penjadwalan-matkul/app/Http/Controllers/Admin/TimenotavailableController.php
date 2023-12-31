<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\Day;
use App\Models\Lecturer;
use App\Models\Time;
use App\Models\Timenotavailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimenotavailableController extends Controller
{    
    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $searchlecturers   = $request->input('searchlecturers');
        $searchday         = $request->input('searchday');
        $timenotavailables = new Timenotavailable;
        // $timenotavailables = Timenotavailable::whereHas('lecturer', function ($query) use ($searchlecturers)
        // {

        //     if (!empty($searchlecturers))
        //     {
        //         $query = $query->where('lecturers.name', 'LIKE', '%' . $searchlecturers . '%');
        //     }
        // })->whereHas('day', function ($query) use ($searchday)
        // {
        //     if (!empty($searchday))
        //     {
        //         $query = $query->where('days.name_day', 'LIKE', '%' . $searchday . '%');
        //     }
        // });

        $timenotavailables = $timenotavailables->orderBy('id', 'Asc')->paginate(10);

        return view('admin.timenotavailable.index', compact('timenotavailables'));
    }

    public function create(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        $lecturers = Lecturer::orderBy('name', 'asc')->pluck('name', 'id');
        $days      = Day::orderBy('name_day', 'asc')->pluck('name_day', 'id');
        $times     = Time::orderBy('range', 'asc')->pluck('range', 'id');

        return view('admin.timenotavailable.create', compact('lecturers', 'days', 'times'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        $this->validate($request, [
            'lecturers' => 'required',
            'days'      => 'required',
            'times'     => 'required',

        ]);

        $params = [
            'lecturers_id' => $request->input('lecturers'),
            'days_id'      => $request->input('days'),
            'times_id'     => $request->input('times'),
        ];

        $timenotavailables = Timenotavailable::create($params);

        return redirect()->route('admin.timenotavailables');
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        $timenotavailables = Timenotavailable::find($id);
        $lecturers         = Lecturer::orderBy('name', 'asc')->pluck('name', 'id');
        $days              = Day::orderBy('name_day', 'asc')->pluck('name_day', 'id');
        $times             = Time::orderBy('range', 'asc')->pluck('range', 'id');

        if ($timenotavailables == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.timenotavailable.edit', compact('timenotavailables', 'lecturers', 'days', 'times'));
    }

    public function update(Request $request, $id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        $this->validate($request, [
            'lecturers' => 'required',
            'days'      => 'required',
            'times'     => 'required',
        ]);

        $timenotavailables               = Timenotavailable::find($id);
        $timenotavailables->lecturers_id = $request->input('lecturers');
        $timenotavailables->days_id      = $request->input('days');
        $timenotavailables->times_id     = $request->input('times');
        $timenotavailables->save();

        return redirect()->route('admin.timenotavailables');
    }

    public function destroy($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        Timenotavailable::find($id)->delete();

        return redirect()->route('admin.timenotavailables')->with('success', 'Waktu berhalangan dosen berhasil dihapus');
    }

}
