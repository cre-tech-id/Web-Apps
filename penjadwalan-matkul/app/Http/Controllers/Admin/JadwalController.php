<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Teach;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{

    public function kosong($id)
    {
        // dd($id);
        try {

            Schedule::whereId($id)->update(['log_kosong' => 1]);
            return redirect(route('admin.bagan.result',['id' => 1]))->with('success', 'Ruangan berhasil ditandai kosong');

        } catch (\Throwable $th) {
            //throw $th;
        }        
    }

    public function isi($id)
    {        
        try {

            Schedule::whereId($id)->update(['log_kosong' => 0]);
            return redirect(route('admin.bagan.result',['id' => 1]))->with('success', 'Ruangan berhasil terisi');

        } catch (\Throwable $th) {
            //throw $th;
        }        
    }

    public function result($id)
    {
        $cek = Schedule::whereId($id)->count();
        if($cek == 0){
            return view('admin.genetik.resultZonk',compact('id'));
        }
        // dd($cek);
        $years          = Teach::select('year')->groupBy('year')->pluck('year', 'year');
        $kromosom       = Schedule::select('type')->groupBy('type')->get()->count();
                
        $value_schedule = Schedule::where('type', $id)->first();
        $kelas          = Room::orderBy('name','ASC')->get();
        // $this->checking($id);
        if (empty($value_schedule))
        {
            abort(404);
        }
        $schedules      = Schedule::orderBy('days_id', 'asc')
        ->orderBy('times_id', 'asc')
        ->where('type', $id)
        ->get();        

        $data = [];
        $hari = Day::orderBy('id','ASC')->get();
        $time = Time::orderBy('id','ASC')->get();        
        $dos  = Auth::user()->id;
        return view('admin.jadwal.bagan', compact('schedules', 'dos','years','kelas','hari','time', 'id', 'value_schedule'));
    }

    public function print($id)
    {

        $cek = Schedule::whereId($id)->count();
        if($cek == 0){
            return view('admin.genetik.resultZonk',compact('id'));
        }
        // dd($cek);
        $years          = Teach::select('year')->groupBy('year')->pluck('year', 'year');
        $kromosom       = Schedule::select('type')->groupBy('type')->get()->count();
                
        $value_schedule = Schedule::where('type', $id)->first();
        $kelas          = Room::orderBy('name','ASC')->get();
        // $this->checking($id);
        if (empty($value_schedule))
        {
            abort(404);
        }
        $schedules      = Schedule::orderBy('days_id', 'asc')
        ->orderBy('times_id', 'asc')
        ->where('type', $id)
        ->get();        
        foreach($schedules as $s){

        }

        $data = [];
        $hari = Day::orderBy('id','ASC')->get();
        $time = Time::orderBy('id','ASC')->get();
        $index = 0;
        $dos  = Auth::user()->id;

        return view('admin.jadwal.print', compact('schedules', 'dos','years','kelas','hari','time', 'id', 'value_schedule'));

        // return view('admin.genetik.print',compact('schedules'));
    }
}