<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\Day;
use App\Models\Timenotavailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $days = Day::orderBy('id', 'Asc')->paginate(10);

        return view('admin.day.index', compact('days'));
    }

    public function create(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        return view('admin.day.create');
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);
         
        $this->validate($request, [
            // 'code_days' => 'unique:days,code_days|required',
            'name_day'  => 'required',

        ]);

        $params = [
            'code_days' => date('dmyhis').rand(0,9999),
            'name_day'  => $request->input('name_day'),
        ];

        $days = Day::create($params);

        return redirect()->route('admin.days');
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $days = Day::find($id);

        if ($days == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.day.edit', compact('days'));
    }

    public function update(Request $request, $id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            // 'code_days' => 'unique:days,code_days,' . $id . '|required',
            'name_day'  => 'required',

        ]);

        $days            = Day::find($id);
        $days->code_days = $request->input('code_days');
        $days->name_day  = $request->input('name_day');
        $days->save();

        return redirect()->route('admin.days');
    }

    public function destroy($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        
        $timenotavailables = Timenotavailable::where('days_id', $id)->first();

        if (!empty($timenotavailables))
        {
            return redirect()->route('admin.times')->with('danger', 'Anda Harus Menghapus Data Waktu Yang Berhalangan yang Berhubungan Dengan Hari Ini Terlebih Dahulu');
        }
        else
        {
            Day::find($id)->delete();
        }

        return redirect()->route('admin.days')->with('success', 'Hari berhasil dihapus');
    }
}
