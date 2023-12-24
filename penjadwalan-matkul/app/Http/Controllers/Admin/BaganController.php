<?php namespace App\Http\Controllers\Admin;

use App\Algoritma\GenerateAlgoritma;
use App\Exports\ResultExport;
use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\Day;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\Teach;
use App\Models\Time;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BaganController extends Controller
{

    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $years = Teach::select('year')->groupBy('year')->pluck('year', 'year');

        return view('admin.genetik.index', compact('years'));
    }

    public function submit(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        try {
            $tek['days_id']     = $request->day_new;
            $tek['times_id']    = $request->waktu_new;
            $tek['rooms_id']    = $request->ruangan_new;
            $id = $request->jadwal;

                Schedule::whereId($id)->update($tek);
                
                return redirect(route('admin.bagan.result',['id' => 1]))->with('success', 'Berhasil pindah jadwal');


        } catch (\Throwable $th) {
            //throw $th;
        }        
    }

    public function kosong($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        try {

            Schedule::whereId($id)->update(['log_kosong' => 1]);
            return redirect(route('admin.bagan.result',['id' => 1]))->with('success', 'Ruangan berhasil ditandai kosong');

        } catch (\Throwable $th) {
            //throw $th;
        }        
    }

    public function isi($id)
    {        
        $role = Auth::user()->role;
        Checking::check($role);

        try {

            Schedule::whereId($id)->update(['log_kosong' => 0]);
            return redirect(route('admin.bagan.result',['id' => 1]))->with('success', 'Ruangan berhasil terisi');

        } catch (\Throwable $th) {
            //throw $th;
        }        
    }

    public function result($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

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

        return view('admin.genetik.bagan', compact('schedules', 'years','kelas','hari','time', 'id', 'value_schedule'));
    }

    public function change($day,$times,$room)
    {        
        $role = Auth::user()->role;
        Checking::check($role);
        
        try {
            $day   = Day::whereId($day)->first();
            $times = Time::whereId($times)->first();
            $room  = Room::whereId($room)->first();
            $schedules      = Schedule::orderBy('days_id', 'asc')
                ->orderBy('times_id', 'asc')
                ->where('type',1)
                ->get();
            return view('admin.genetik.change', compact('schedules','day','room','times'));
        } catch (\Throwable $th) {
            return redirect(route('admin.bagan.result',['id' => 1]));
        }
    }

    public function print($id)
    {
        $schedules = Schedule::orderBy('days_id', 'asc')
            ->orderBy('times_id', 'asc')
            ->where('type', $id)
            ->get();

        return view('admin.genetik.print',compact('schedules'));
    }

}
