<?php namespace app\Algoritma;

use App\Models\Day;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Teach;
use App\Models\Time;
use App\Models\Timenotavailable;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class GenerateAlgoritma
{
    public function randKromosom($kromosom, $count_teachs, $input_year, $input_semester)
    {
        
        
        // for ($i = 0; $i < $kromosom; $i++)
        // {
            
            $values = [];
            $bagi =$count_teachs / 5;
                $teach = Teach::join('courses','courses.id','teachs.courses_id')
                ->where('courses.semester',$input_semester)
                ->inRandomOrder()
                ->select('teachs.id','teachs.courses_id','teachs.lecturers_id','teachs.log')
                ->get();
                $m = 1;
                foreach($teach as $t){
                    $dosen = $t->lecturers_id;
                    $day   = Day::inRandomOrder()->first();

                    $room  = Room::where('type', $t->course->type)->inRandomOrder()->first();
                    $time  = Time::where('sks', $t->course->sks)->inRandomOrder()->first();

                    $cek   = Schedule::where('matkul_id',$t->courses_id)->where('days_id',$day->id)->where('times_id',$time->id)->get();
                    if(count($cek) >= 1){
                        $day   = Day::where('id','!=',$day->id)->inRandomOrder()->first();

                    }

                    $params = [
                        'teachs_id' => $t->id,
                        'matkul_id' => $t->courses_id,
                        'dosen_id'  => $dosen,
                        'days_id'   => $day->id,
                        'times_id'  => $time->id,
                        'rooms_id'  => $room->id,
                        'type'      => 0 + 1,
                    ];

                    $schedule = Schedule::create($params);

                    $m = $m+1;
                }
            $data[] = $values;
        // }
        
        return $data;
    }

    public function testKromosom($kromosom, $count_teachs, $input_year, $input_semester)
    {
        
        $values = [];
        $bagi =$count_teachs / 5;

        $teach = Teach::join('courses','courses.id','teachs.courses_id')
        ->where('courses.semester',$input_semester)
        ->where('teachs.log',0)
        ->inRandomOrder()
        ->select('teachs.id','teachs.courses_id','teachs.lecturers_id','teachs.log')
        ->get();

        $m = 1;
        foreach($teach as $t){
            $dosen = $t->lecturers_id;
            $day   = Day::inRandomOrder()->first();

            $room  = Room::where('type', $t->course->type)->inRandomOrder()->first();
            $time  = Time::where('sks', $t->course->sks)->inRandomOrder()->first();

            $cek   = Schedule::where('rooms_id',$room->id)->where('days_id',$day->id)->where('times_id',$time->id)->get();
            if(count($cek) >= 1){
                $day   = Day::where('id','!=',$day->id)->inRandomOrder()->first();
            }

            $cek2   = Schedule::where('matkul_id',$t->courses_id)->where('days_id',$day->id)->where('times_id',$time->id)->get();
            if(count($cek2) >= 1){
                $day   = Day::where('id','!=',$day->id)->inRandomOrder()->first();
            }

            $params = [
                'teachs_id' => $t->id,
                'matkul_id' => $t->courses_id,
                'dosen_id'  => $dosen,
                'days_id'   => $day->id,
                'times_id'  => $time->id,
                'rooms_id'  => $room->id,
                'type'      => 0 + 1,
            ];

            $schedule = Schedule::create($params);
            Teach::whereId($t->id)->update([
                'log' => 1,
            ]);
            $m = $m+1;
        }
            $data[] = $values;
   
        return $data;
    }

    public function fixKromosom($kromosom, $count_teachs, $input_year, $input_semester)
    {
        // for ($i=0; $i < 9; $i++) { 
            $hari          = Day::orderBy('id','ASC')->get();
            $totalRuangan = Room::count();
            $totalWaktu   = Time::count();
            $bagi1        = round($count_teachs / count($hari));
            $hasil        = $bagi1 / $totalWaktu;
            $hasil        = (int) $hasil;

            foreach($hari as $h){
                $id_hari = $h->id;

                $jam = Time::orderBy('id','ASC')->get();
                foreach($jam as $j){
                    for ($i=0; $i < $hasil ; $i++) { 
                        $teach = Teach::join('courses','courses.id','teachs.courses_id')
                        ->where('courses.semester',$input_semester)
                        ->where('courses.sks',$j->sks)
                        ->where('teachs.log',0)
                        ->inRandomOrder()
                        ->select('teachs.id','teachs.courses_id','courses.sks','teachs.lecturers_id','teachs.log')
                        ->first();
        
                        if($teach){
                            $room  = Room::where('type', $teach->course->type)->inRandomOrder()->first();  
                            
                            // $cek   = Schedule::where('matkul_id',$teach->courses_id)->where('days_id',$id_hari)->where('rooms_id',$room->id)->where('times_id',$j->id)->get();
                            // if(count($cek) <= 1){
                                $params = [
                                    'teachs_id' => $teach->id,
                                    'matkul_id' => $teach->courses_id,
                                    'dosen_id'  => $teach->lecturers_id,
                                    'days_id'   => $id_hari,
                                    'times_id'  => $j->id,
                                    'rooms_id'  => $room->id,
                                    'type'      => 0 + 1,
                                ];
                                // dd($params);
            
                                $schedule = Schedule::create($params);
            
                                Teach::whereId($teach->id)->update([
                                    'log' => 1,
                                ]);
                                // $room   = Room::where('id','!=',$room->id)->where('type', $teach->course->type)->inRandomOrder()->first();

                            // }
                            // dd($teach);
                        }
                    }
                }
            }
            // $this->checkingGenerate(1);
        // }

        return true;
    }

    public function checkingGenerate($id){
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

    public function checkPinalty()
    {
        $schedules = Schedule::select(DB::raw('teachs_id, days_id, times_id, type, count(*) as `jumlah`'))
            ->groupBy('teachs_id')
            ->groupBy('days_id')
            ->groupBy('times_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();
            

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::select(DB::raw('teachs_id, days_id, rooms_id, type, count(*) as `jumlah`'))
            ->groupBy('teachs_id')
            ->groupBy('days_id')
            ->groupBy('rooms_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::select(DB::raw('times_id, days_id, rooms_id, type, count(*) as `jumlah`'))
            ->groupBy('times_id')
            ->groupBy('days_id')
            ->groupBy('rooms_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::join('teachs', 'teachs.id', '=', 'schedules.teachs_id')
            ->join('lecturers', 'lecturers.id', '=', 'teachs.lecturers_id')
            ->select(DB::raw('lecturers_id, days_id, times_id, type, count(*) as `jumlah`'))
            ->groupBy('lecturers_id')
            ->groupBy('days_id')
            ->groupBy('times_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::where('days_id', Schedule::FRIDAY)->whereIn('times_id', [12, 19, 24])->get();

        if (!empty($schedules))
        {
            foreach ($schedules as $key => $schedule)
            {
                $schedule->value         = $schedule->value + 1;
                $schedule->value_process = $schedule->value_process . "+ 1 ";
                $schedule->save();
            }
        }

        $time_not_availables = Timenotavailable::get();

        if (!empty($time_not_availables))
        {
            foreach ($time_not_availables as $k => $time_not_available)
            {
                $schedules = Schedule::whereHas('teach', function ($query) use ($time_not_available)
                {
                    $query = $query->whereHas('lecturer', function ($q) use ($time_not_available)
                    {
                        $q->where('lecturers.id', $time_not_available->lecturers_id);
                    });
                });

                $schedules = $schedules->where('days_id', $time_not_available->days_id)->where('times_id', $time_not_available->times_id)->get();

                if (!empty($schedules))
                {
                    foreach ($schedules as $key => $schedule)
                    {
                        $schedule->value         = $schedule->value + 1;
                        $schedule->value_process = $schedule->value_process . "+ 1 ";
                        $schedule->save();
                    }
                }

            }
        }

        $schedules = Schedule::get();

        foreach ($schedules as $key => $schedule)
        {
            $schedule->value = 1 / (1 + $schedule->value);
            $schedule->save();
        }

        return $schedules;
    }

    public function increaseProccess($schedules = '')
    {
        if (!empty($schedules))
        {
            // dd($schedules);
            foreach ($schedules as $key => $schedule)
            {
                if ($schedule->jumlah > 1)
                {
                    $schedule_wheres = Schedule::where('type', $schedule->type)->get();
                    foreach ($schedule_wheres as $key => $schedule_where)
                    {
                        $schedule_where->value         = $schedule_where->value + ($schedule->jumlah - 1);
                        $schedule_where->value_process = $schedule_where->value_process . " + " . ($schedule->jumlah - 1);
                        $schedule_where->save();
                    }
                }
            }
        }
        return $schedules;
    }

}
