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

class GenetikController extends Controller
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
        ini_set('memory_limit', '512M');
        set_time_limit(0);
        
        Teach::query()->update(['log' => 0]);
        
        $years            = Teach::select('year')->groupBy('year')->pluck('year', 'year');
        $input_kromosom   = $request->input('kromosom');
        $input_year       = $request->input('year');
        $input_semester   = $request->input('semester');
        $input_generasi   = $request->input('generasi');
        $input_crossover  = $request->input('crossover');
        $input_mutasi     = $request->input('mutasi');
        $count_lecturers  = Lecturer::count();
        // $count_teachs     = Teach::where('')->count();
        $count_teachs     = Teach::join('courses','courses.id','teachs.courses_id')
                ->where('courses.semester',$input_semester)
                ->count();
        if($count_teachs == 0){
            return redirect()->back()->withInput(Input::all())->with('warning', 'Mata Kuliah Semester '.$input_semester.' tidak ada');
        }
        Schedule::truncate();
        $kromosom         = $input_kromosom * $input_generasi;
        $crossover        = $input_kromosom * $input_crossover;
        $generate         = new GenerateAlgoritma;
        // dd($generate);
        $data_kromosoms   = $generate->randKromosom($kromosom, $count_teachs);
        $result_schedules = $generate->checkPinalty();

        $total_gen        = Setting::firstOrNew(['key' => 'total_gen']);
        $total_gen->name  = 'Total Gen';
        $total_gen->value = $crossover;
        $total_gen->save();

        $mutasi        = Setting::firstOrNew(['key' => 'mutasi']);
        $mutasi->name  = 'Mutasi';
        $mutasi->value = (3 * $count_teachs) * $input_kromosom * $input_mutasi;
        $mutasi->save();
        
        return redirect()->route('admin.generates.result', 1);
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
        
        $crossover      = Setting::where('key', Setting::CROSSOVER)->first();
        $mutasi         = Setting::where('key', Setting::MUTASI)->first();
        $value_schedule = Schedule::where('type', $id)->first();
        $this->checking($id);
        if (empty($value_schedule))
        {
            abort(404);
        }
        $schedules      = Schedule::orderBy('days_id', 'asc')
        ->orderBy('times_id', 'asc')
        ->where('type', $id)
        ->paginate();
        for ($i = 1; $i <= $kromosom; $i++)
        {
            $value_schedules = Schedule::where('type', $i)->first();
            $data_kromosom[] = [
                'value_schedules' => $value_schedules->value,

            ];
        }

        return view('admin.genetik.result', compact('schedules', 'years', 'data_kromosom', 'id', 'value_schedule', 'crossover', 'mutasi'));
    }

    public function checking($id){
        $role = Auth::user()->role;
        Checking::check($role);

        $schedules      = Schedule::where('type', $id)->get();
        Schedule::query()->update(['log' => 0]);
        foreach($schedules as $d){

            $check_lecturers_id = Schedule::join('teachs', 'teachs.id', '=', 'schedules.teachs_id')
            ->join('lecturers', 'lecturers.id', '=', 'teachs.lecturers_id')
            ->where('lecturers_id', '=', $d->lecturers_id)
            ->where('days_id', '=', $d->days_id)
            ->where('times_id', '=', $d->times_id)
            ->where('type', '=', 1)
            ->get();
            

            // filter agar satu kelas tidak memiliki hari dan waktu pelajaran yang sama 2 kali
            $check_class_id = Schedule::where('rooms_id', '=', $d->teach->class_room)
            ->where('days_id', '=', $d->days_id)
            ->where('times_id', '=', $d->times_id)
            ->where('type', '=', 1)
            ->get();
            
            if(count($check_lecturers_id) > 1){       
                // dd($check_lecturers_id);                 
                foreach($check_lecturers_id as $cd){
                    Schedule::whereId($cd->id)->update([
                        'log' => 1
                    ]);
                }   
            }else if(count($check_class_id) > 1)
            {
                // dd($check_class_id);                 
                foreach($check_class_id as $cc){
                    Schedule::whereId($cc->id)->update([
                        'log' => 1
                    ]);
                }
            }
            
        }

        // foreach($schedules as $d){
        //     $cekDay = Schedule::whereDaysId($d->days_id)->where('times_id',$d->times_id)->whereMatkulId($d->matkul_id)->where('type', $id)->get();

        //     if(count($cekDay) > 1){
        //         foreach($cekDay as $cd){
        //             Schedule::whereId($cd->id)->update([
        //                 'log' => 1
        //             ]);
        //             // echo $cd->id.' - ';
        //             // echo $cd->matkul_id.' - ';
        //             // echo $cd->days_id.' - ';
        //             // echo $cd->times_id.'<br>';
        //         }                
        //     }

        //     $cekDay2 = Schedule::whereDaysId($d->days_id)->where('times_id',$d->times_id)->whereRoomsId($d->rooms_id)->where('type', $id)->get();

        //     if(count($cekDay2) > 1){
        //         foreach($cekDay2 as $cd2){
        //             Schedule::whereId($cd2->id)->update([
        //                 'log' => 1
        //             ]);
        //             // echo $cd->id.' - ';
        //             // echo $cd->matkul_id.' - ';
        //             // echo $cd->days_id.' - ';
        //             // echo $cd->times_id.'<br>';
        //         }                
        //     }
            
        // }


        // return true;
    }

    public function checkingGenerate($id){
        $role = Auth::user()->role;
        Checking::check($role);

        $schedules      = Schedule::where('type', $id)->get();

        foreach($schedules as $d){
            $cekDay = Schedule::whereDaysId($d->days_id)->where('times_id',$d->times_id)->whereMatkulId($d->matkul_id)->where('type', $id)->get();

            if(count($cekDay) > 1){
                foreach($cekDay as $cd){
                    Teach::whereId($cd->teachs_id)->update([
                        'log' => 0
                    ]);

                    Schedule::whereId($cd->id)->delete();                
                }                
            }

            $cekDay2 = Schedule::whereDaysId($d->days_id)->where('times_id',$d->times_id)->whereRoomsId($d->rooms_id)->where('type', $id)->get();

            if(count($cekDay2) > 1){
                foreach($cekDay2 as $cd2){
                    Teach::whereId($cd2->teachs_id)->update([
                        'log' => 0
                    ]);

                    Schedule::whereId($cd2->id)->delete();   
                }                
            }
            
        }

        // return true;
    }

    public function delete($id){
        $role = Auth::user()->role;
        Checking::check($role);

        try {

            DB::beginTransaction();
                Schedule::truncate();
                return redirect()->route('admin.generates.result', 1);
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function excel($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        
        $schedules = Schedule::orderBy('days_id', 'asc')
            ->orderBy('times_id', 'asc')
            ->where('type', $id)
            ->get();
        return view('admin.genetik.export',compact('schedules'));
        // return Excel::download(new ResultExport, 'Hasil Result.xlsx');
        // return Excel::create('Algoritma Genetika', function ($excel) use ($schedules)
        // {
        //     $excel->sheet('Genetika', function ($sheet) use ($schedules)
        //     {
        //         $sheet->loadView('admin.genetik.export')->with('schedules', $schedules);
        //     });
        // })->export('xlsx');

        return redirect()->back();
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

        return view('admin.genetik.print', compact('schedules', 'years','kelas','hari','time', 'id', 'value_schedule'));

        // return view('admin.genetik.print',compact('schedules'));
    }

}
