<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\Day;
use App\Models\Time;
use App\Models\Timeday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimedayController extends Controller
{

    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $timedays = Timeday::orderBy('id', 'Asc')->paginate(10);

        return view('admin.timeday.index', compact('timedays'));
    }

    public function create(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $days  = Day::orderBy('name_day', 'asc')->pluck('name_day', 'id');
        $times = Time::orderBy('range', 'asc')->pluck('range', 'id');

        return view('admin.timeday.create', compact('days', 'times'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            'code_timedays' => 'required',
            'days'          => 'required',
            'times'         => 'required',

        ]);

        $params = [
            'code_timedays' => $request->input('code_timedays'),
            'days_id'       => $request->input('days'),
            'times_id'      => $request->input('times'),
        ];

        $timedays = Timeday::create($params);

        return redirect()->route('admin.timedays');
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $timedays = Timeday::find($id);
        $days     = Day::orderBy('name_day', 'asc')->pluck('name_day', 'id');
        $times    = Time::orderBy('range', 'asc')->pluck('range', 'id');

        if ($timedays == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.timeday.edit', compact('timedays', 'days', 'times'));
    }

    public function update(Request $request, $id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            'code_timedays' => 'required',
            'days'          => 'required',
            'times'         => 'required',
        ]);

        $timedays                = Timeday::find($id);
        $timedays->code_timedays = $request->input('code_timedays');
        $timedays->days_id       = $request->input('days');
        $timedays->times_id      = $request->input('times');
        $timedays->save();

        return redirect()->route('admin.timedays');
    }

    public function destroy($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        
        Timeday::find($id)->delete();

        return redirect()->route('admin.timedays')->with('success', 'Waktu berhalangan dosen berhasil dihapus');
    }

}
